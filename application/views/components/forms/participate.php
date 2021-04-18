<section class="pop_up" id="pop_up_participate">
	<div class="form_wrapper">
        <div class="form_close_btn close_participate">&#10006;</div>
		<form id="form_participate">
			<div class="form_title">
				<?= TRANSLATE['WANT_PARTICIPATE'][LANG]; ?>
			</div>
			<input type="text"
				   class="input_text full_size mb-5"
				   id="name_participate"
                   required
				   placeholder="<?= TRANSLATE['FIO'][LANG]; ?>"
			>
			<div class="input_wrapper">
				<input type="tel"
					   class="input_text mb-5"
					   id="phone_participate"
                       required
					   placeholder="<?= TRANSLATE['PHONE_NUMBER'][LANG]; ?>"
				>
				<input type="text"
					   class="input_text mb-5"
					   id="city_participate"
                       required
					   placeholder="<?= TRANSLATE['CITY'][LANG]; ?>"
				>
			</div>
            <div class="input_wrapper">
                <input type="number"
                       class="input_text mb-5"
                       id="age_participate"
                       required
                       placeholder="<?= TRANSLATE['AGE'][LANG]; ?>"
                >
                <input type="email"
                       class="input_text mb-5"
                       id="email_participate"
                       required
                       placeholder="<?= TRANSLATE['EMAIL'][LANG]; ?>"
                >
            </div>
            <div class="checkbox_wrapper">
                <div class="form_checkbox">
                    <div class="custom_checkbox border_gradient">
                        <span class="checkbox_body form_checkbox_gender active_checkbox js_gender"
                              data-gender="<?= TRANSLATE['MEN'][LANG]; ?>">
                        </span>
                    </div>
					<?= TRANSLATE['MEN'][LANG]; ?>
                </div>
                <div class="form_checkbox">
                    <div class="custom_checkbox border_gradient">
                        <span class="checkbox_body form_checkbox_gender"
                              data-gender="<?= TRANSLATE['FEMALE'][LANG]; ?>"></span>
                    </div>
					<?= TRANSLATE['FEMALE'][LANG]; ?>
                </div>
            </div>
			<input type="submit" class="btn_submit" value="<?= TRANSLATE['SEND'][LANG]; ?>">
		</form>
</section>