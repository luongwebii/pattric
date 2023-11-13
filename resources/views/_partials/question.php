<div class="question row">
    <div class="col-md-6">
        
        <div class="mb-2"> <label  class="form-label">Question 1:</label></div>
        <input type="hidden" name="questions[0][question_id]" value="">
        <textarea name="questions[0][question_name]" class="form-control" id="courses_topics_embed_code" rows="7" cols="50" spellcheck="false"></textarea>
        <button type="button" class="remove-question  btn btn-danger mt-1">Remove question</button>
    </div>
    
    <div class="col-md-6">
        <div class="mb-2"> <label  class="form-label">Answers:</label></div>
        
        <div class="answer-option input-group control-group  increment mt-1">
            <div class="input-group-text">  
                <input type="checkbox" value="1" name="questions[0][correct_answers][0]" class="correct_answers form-check-input mt-0">
            </div>
            <input type="text" name="questions[0][options][0]" placeholder="Option 1" class="form-control">
            <input type="hidden" name="questions[0][choice_id][0]" value="">
            <button class="remove-option btn btn-danger">Remove Option</button>
        </div>

        <div class="mb-2  mt-2 feedback">
            <label for="email" class="form-label">Feedback </label>
            <input type="text" name="questions[0][quizzes_questions_feedback]" class="form-control">
        </div>
        <button class="add-option btn btn-success  mt-3">Add Option</button>
    </div>
    <hr class="my-4">
</div>