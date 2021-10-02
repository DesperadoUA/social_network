<form class="form_contacts" id="form_contacts">
	<div class="form_title color_black text_left">
		<?= TRANSLATE['CONTACT_FORM_TITLE'][LANG]; ?>
	</div>
	<input type="text"
		   class="input_text full_size mb-5 bg_gray"
		   id="name_contacts"
		   required
		   placeholder="<?= TRANSLATE['FIO'][LANG]; ?>" >
    <div class="input_wrapper">
        <input type="tel"
               class="input_text mb-5 bg_gray"
               id="phone_contacts"
               required
               placeholder="<?= TRANSLATE['PHONE_NUMBER'][LANG]; ?>"
        >
        <input type="text"
               class="input_text mb-5 bg_gray"
               id="city_contacts"
               required
               placeholder="<?= TRANSLATE['CITY'][LANG]; ?>"
        >
    </div>
	<input type="submit" class="btn_submit btn_submit_contacts" value="<?= TRANSLATE['SEND'][LANG]; ?>">
</form>