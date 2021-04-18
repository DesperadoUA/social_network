<section class="pop_up" id="pop_up_active">
	<div class="form_wrapper">
        <div class="form_close_btn close_research">&#10006;</div>
        <form id="form_active">
            <div class="form_title">
                <?= TRANSLATE['WRITE_RESEARCHERS'][LANG]; ?>
            </div>
		    <input type="text"
                   class="input_text full_size mb-5"
                   id="name_research"
                   required
                   placeholder="<?= TRANSLATE['FIO'][LANG]; ?>"
            >
            <div class="input_wrapper">
                <input type="tel"
                       class="input_text mb-5"
                       id="phone_research"
                       required
                       placeholder="<?= TRANSLATE['PHONE_NUMBER'][LANG]; ?>"
                >
                <input type="text"
                       class="input_text mb-5"
                       id="city_research"
                       required
                       placeholder="<?= TRANSLATE['CITY'][LANG]; ?>"
                >
            </div>
            <input type="submit" class="btn_submit" value="<?= TRANSLATE['SEND'][LANG]; ?>">
	    </form>
    </div>
</section>