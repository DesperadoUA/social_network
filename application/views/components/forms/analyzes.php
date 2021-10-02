<section class="pop_up" id="pop_up_analyzes">
	<div class="form_wrapper analyzes_form_wrapper">
        <div class="form_close_btn close_analyzes">&#10006;</div>
        <form id="form_analyzes">
            <div class="form_title">
                <?= TRANSLATE['ANALYZES_TITLE'][LANG]; ?>
            </div>
            <div class="form_desc">
                <?= TRANSLATE['ANALYZES_FORM_DESC'][LANG]; ?>
            </div>
            <label class="file_label" for="file_analyzes">
				<?= TRANSLATE['SELECT_FILE'][LANG]; ?>
            </label>
            <input id="file_analyzes"
                   required type="file"
                   accept=".txt,.pdf"
                   style="display: none;">
            <textarea class="textarea full_size"
                      id="comment_analyzes"
                      placeholder="<?= TRANSLATE['COMMENT'][LANG]; ?>"
            ></textarea>
		    <input type="text"
                   class="input_text full_size mb-5"
                   id="name_analyzes"
                   required
                   placeholder="<?= TRANSLATE['FIO'][LANG]; ?>"
            >
            <input type="tel"
                   class="input_text full_size mb-5"
                   id="phone_analyzes"
                   required
                   placeholder="<?= TRANSLATE['PHONE_NUMBER'][LANG]; ?>"
            >
            <input type="submit" class="btn_submit" value="<?= TRANSLATE['SEND'][LANG]; ?>">
	    </form>
    </div>
</section>