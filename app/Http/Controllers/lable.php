<?php
use symbio\user\classes\ShippingLabel;
include_once('../symbio.php');
include_once('constants.php');//include class help function
include_once(SYMBIO_DIR_BASE.'user/classes/ShippingLabel.php');
$user = new WebUser();
const PRODUCTION_URL = 'https://ws.fedex.com:443/web-services/ifss';
const TESTING_URL = 'https://wsbeta.fedex.com:443/web-services/ifss';
const FEDEX_API_KEY = 'l795cd6d2ae00442d290255c5bc85f046b';// 'l795cd6d2ae00442d290255c5bc85f046b';
const FEDEX_SECRET_KEY =  '8056fdb4b7f54979be2dab542cb1866c';//'8056fdb4b7f54979be2dab542cb1866c';
const FEDEX_API_BASE_URL = 'https://apis-sandbox.fedex.com';
const FEDEX_ACCOUNT_NUMBER = '740561073';
$fedex_account_number = '208205994';

$path_to_wsdl = "./ShipService_v19.wsdl";

ini_set("soap.wsdl_cache_enabled", "0");




if (!$user->has_credential('logged_in')){
    echo json_encode([
        'status' => 401,
        'message' => 'Unauthorized!',
    ]);
    exit(); 
} else {
	$helper = new ReturnsHelper();
	if(isset($_REQUEST['reference_number'])){
		$reference_number = $_REQUEST['reference_number'];
        $data['reference_number'] = $reference_number;
        $order_return = $helper->returnDetailData($data);
		
       
		
        $document = $order_return['order_returns_tmd']['document'];
		//$shipping_label->retrieveShippingLabel($jobId);
        if(!empty($document)) {
           
			echo json_encode([
				//'serviceName' => $transactionShipment->serviceName,
				'document' => $document,
				'code' => 1,
				'trackingNumber' => $order_return['order_returns_tmd']['trackingNumber']
			]);
			exit();
            
        } else {
			$item_id = $_REQUEST['item_id'];
			$invoice_id = $_REQUEST['invoice_id'];
			$path = '/homepages/33/d146155886/htdocs/tmdfiles11/TMDFiles11/Supplier_Data.txt';
			
			//echo dirname(__FILE__);
			//echo $path, file_exists($path) ? ' exists' : ' does not exist', "\n";
			$fp = fopen ($path, "r");
			//var_dump($fp);
			//while ($data1 = fgetcsv ($fp)) {
			$weight = '';
			while ($data1 = fgetcsv ($fp, 2000, "\t")) {
				$new_data = array();
				if($data1[1] == $item_id){
					$weight = (float)$data1[3];// weight (LBS)
					$dimensions = (float)$data1[4];//cube (size dimensions)
					break;
				}
				
				
			}
			
			if(empty($weight)){
				/* echo json_encode([
					'code' => 0,
                    'message' => "Weight is empty"
                ]);
				*/
				$weight = 2;
				//die();
			}
			$shipping_label = new ShippingLabel();
            $helper2 = new UserHelper($user);
            $helperUser = $helper2->get_selected_user();
            $account_name = $helperUser->get_first_name() . ' ' . $helperUser->get_last_name();
            $data = [
                'labelResponseOptions' => 'LABEL',
                'accountNumber' => [
                    'value' => $fedex_account_number
                ],
                'requestedShipment' => [
                    'shipper' => [
                        'address' => [
                            'streetLines' => array(
                                $order_return['order_returns']['product_address1']
                            ),
                            'city' => $order_return['order_returns']['product_city'],
                            'stateOrProvinceCode' => $order_return['order_returns']['product_state'],
                            'postalCode' => $order_return['order_returns']['product_zip'],
                            'countryCode' => 'US'
                        ],
                        'contact' => [
                            'personName' => $order_return['order_returns']['contact_person'],
                            'emailAddress' => $order_return['order_returns']['contact_email'],
                            'phoneNumber' => $order_return['order_returns']['contact_number'],
                            'companyName' => $account_name
                        ]
                    ],
                    'recipients' => array([
						'address' => [
                            'streetLines' => array(
                                '403 N. Highway 77'
                            ),
                            'city' => 'Rockdale',
                            'stateOrProvinceCode' => 'TX',
                            'postalCode' => '76567',
                            'countryCode' => 'US'
                        ],
                        'contact' => [
                            'personName' => '',
                            'emailAddress' => 'customerservice@gotmd.com',
                            'phoneNumber' => '8007536291',
                            'companyName' => 'Texas Medical Distributors inc'
                        ]
						
                        
                    ]),//ON_CALL TAG
                    'pickupType' => 'DROPOFF_AT_FEDEX_LOCATION',
                    'serviceType' => 'FEDEX_GROUND',
                    'packagingType' => 'YOUR_PACKAGING',
                    'shippingChargesPayment' => [
                        'paymentType' => 'SENDER'
                    ],
                    'labelSpecification' => [
                        'labelStockType' => 'PAPER_4X6',
                        'imageType' => 'PDF'
                    ],
                    'requestedPackageLineItems' => array(
                        [
                            'weight' => [
                                'units' => 'LB',
                                'value' => $weight,
                            ]
                        ]
                    )
                ]
            ];

//            var_dump($_SESSION['fedex_token']);
//            exit();

            $response = $shipping_label->createShippingLabel($data);//echo '<pre>';print_r($response);
//            var_dump(json_encode($data));
            if(isset($response['response'])) {
                $res_data = $response['response'];
                if(isset($res_data->errors)) {
					$result['code'] = $res_data->errors[0]->code;
					$result['message'] = $res_data->errors[0]->message;/// (array)$res_data->errors;
                    echo json_encode($result);
                    exit();
                }

                $output = $res_data->output;
                $transactionShipments = $output->transactionShipments;
				$jobId = '';
                if(isset($output->jobId)) {
                    $jobId = $output->jobId;
                }
				

                $transactionShipment = $transactionShipments[0];
                $masterTrackingNumber = $transactionShipment->masterTrackingNumber;
				$serviceName = $transactionShipment->serviceName;
				
				$document = $transactionShipment->pieceResponses[0]->packageDocuments[0]->encodedLabel;
				
				$order_return = $helper->updateShippingLabelData($serviceName, $document, $masterTrackingNumber, $jobId, $reference_number);
			
                echo json_encode([
                    'serviceName' => $transactionShipment->serviceName,
                    'document' => $document,
					'code' => 1,
                    'trackingNumber' => $masterTrackingNumber
                ]);
                exit();
            } else {
                echo json_encode([
                    'errors' => $response['error']
                ]);
                exit();
            }
        }

    }
}
 echo json_encode([
                    'errors' => $response['error']
                ]);
                exit();

?>