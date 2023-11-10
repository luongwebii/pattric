<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">

$(document).ready(function() {
        var questionIndex = 1;

        $('#add-question').click(function(e) {
            e.preventDefault();
            var questionHtml = `

                <div class="question row">
                    <div class="col-md-6">
                        
                        <div class="mb-2"> <label  class="form-label">Question ${questionIndex + 1}:</label></div>
                        
                        <textarea name="questions[${questionIndex}][question_name]" class="form-control" id="courses_topics_embed_code" rows="7" cols="50" spellcheck="false"></textarea>
                        <button type="button" class="remove-question  btn btn-danger mt-1">Remove question</button>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-2"> <label  class="form-label">Answers:</label></div>
                        
                        <div class="answer-option input-group control-group  increment mt-1">
                            <div class="input-group-text">  
                                <input type="checkbox" value="1" name="questions[${questionIndex}][correct_answers][0]" class="correct_answers form-check-input mt-0">
                            </div>
                            <input type="text" name="questions[${questionIndex}][options][0]" placeholder="Option 1" class="form-control">
                              <input type="hidden" name="questions[${questionIndex}][choice_id][0]" value="">
                            <button class="remove-option btn btn-danger">Remove Option</button>
                        </div>
                        <div class="mb-2  mt-2 feedback">
                            <label for="email" class="form-label">Feedback </label>
                            <input type="text" name="questions[${questionIndex}][quizzes_questions_feedback]" class="form-control">
                        </div>
                        <button class="add-option btn btn-success  mt-3">Add Option</button>
                    </div>
                    <hr class="my-4">
                </div>

            `;
            $('#questions').append(questionHtml);
            questionIndex++;
        });

        $('#questions').on('click', '.add-option', function(e) {
            e.preventDefault();
            var questionIndex = $(this).closest('.question').index();
            var optionIndex = $(this).closest('.question').find('.answer-option').length;
            var optionHtml = `
                <div class="answer-option input-group control-group  increment  mt-1">
                    <div class="input-group-text">  
                        <input type="checkbox" value="1" name="questions[${questionIndex}][correct_answers][${optionIndex}]" class="correct_answers form-check-input mt-0">
                    </div>
                    <input type="text" name="questions[${questionIndex}][options][${optionIndex}]" placeholder="Option ${optionIndex + 1}" class="form-control">
                    <input type="hidden" name="questions[${questionIndex}][choice_id][${optionIndex}]" value="">
                    <button class="remove-option btn btn-danger">Remove Option</button>
                </div>

            `;
            $(this).closest('.row').find('.feedback').before(optionHtml);
        });

        $('#questions').on('click', '.remove-option', function(e) {
            e.preventDefault();
            $(this).closest('.answer-option').remove();
        });

        $('#questions').on('click', '.remove-question', function(e) {
            e.preventDefault();
            if(confirm('Are you sure you want to remove this question + answers?')) {
                $(this).closest('.question').remove();
            }
           
        });
    });
</script>