<section class="subscription_form">
    <div class="container">
        <div class="row_subscription_form">
            <div class="subscription_form_left">

            </div>
            <div class="subscription_form_right">
                <p class="subscription_form_title"><?= TRANSLATE['FORM_SUBSCRIPTION_TITLE'][LANG]; ?></p>
                <form id="subscription_form">
                    <input type="text" class="input_text full_size mb-5"
                           id="subscription_form_fio"
                           required=""
                           placeholder="<?= TRANSLATE['FIO'][LANG] ?>">
                    <div class="input_wrapper">
                        <input type="tel" class="input_text mb-5"
                               id="subscription_form_phone" required=""
                               placeholder="<?= TRANSLATE['PHONE_NUMBER'][LANG] ?>">
                        <input type="email" class="input_text mb-5"
                               id="subscription_form_email" required=""
                               placeholder="<?= TRANSLATE['EMAIL'][LANG] ?>">
                    </div>
                    <div class="input_wrapper">
                        <input type="number" class="input_text mb-5"
                               id="subscription_form_age"
                               placeholder="<?= TRANSLATE['AGE'][LANG] ?>">
                        <input type="text" class="input_text mb-5"
                               id="subscription_form_city"
                               placeholder="<?= TRANSLATE['CITY'][LANG] ?>">
                    </div>
                    <div class="checkbox_wrapper">
                        <div class="form_checkbox">
                            <div class="custom_checkbox border_gradient">
                        <span class="checkbox_body form_checkbox_gender active_checkbox js_gender"
                              data-gender="<?= TRANSLATE['MEN'][LANG] ?>">
                        </span>
                            </div>
							<?= TRANSLATE['MEN'][LANG] ?>
                        </div>
                        <div class="form_checkbox">
                            <div class="custom_checkbox border_gradient">
                                <span class="checkbox_body form_checkbox_gender"
                                      data-gender="<?= TRANSLATE['FEMALE'][LANG] ?>">
                                </span>
                            </div>
							<?= TRANSLATE['FEMALE'][LANG] ?>
                        </div>
                    </div>
                    <input type="submit" class="btn_submit" value="<?= TRANSLATE['SEND'][LANG]; ?>" >
                </form>
            </div>
        </div>
    </div>
</section>