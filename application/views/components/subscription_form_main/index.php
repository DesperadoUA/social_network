<section class="subscription_form_main" id="form">
    <div class="container">
        <div class="row_subscription_form_main">
            <div class="subscription_form_main_left">
                <p class="subscription_form_main_ttl">
                    <?= TRANSLATE['FORM_SUBSCRIPTION_MAIN_TITLE'][LANG]; ?>
                </p>
                <p class="subscription_form_main_subttl">
                    <?= TRANSLATE['FORM_SUBSCRIPTION_MAIN_SUBTITLE'][LANG]; ?>
                </p>
                <div class="subscription_form_main_important">
                    <p>
						<?= TRANSLATE['IMPORTANT'][LANG]; ?>
                    </p>
                    <p>
                        <?= TRANSLATE['IMPORTANT_DESC'][LANG]; ?>
                    </p>
                </div>
                <div class="subscription_form_main_desc">
                    <?= $body['content']['text']; ?>
                </div>
            </div>
            <div class="subscription_form_main_right">
                <form id="subscription_form_main">
                    <input type="text" class="input_text full_size mb-10 border"
                           id="subscription_form_main_fio"
                           required=""
                           placeholder="<?= TRANSLATE['FIO'][LANG] ?>">
                    <input type="email" class="input_text full_size mb-10 border"
                           id="subscription_form_main_email" required=""
                           placeholder="<?= TRANSLATE['EMAIL'][LANG] ?>">
                    <input type="number" class="input_text full_size mb-10 border"
                           id="subscription_form_main_age"
                           placeholder="<?= TRANSLATE['AGE'][LANG] ?>">
                    <input type="text" class="input_text full_size mb-10 border"
                           id="subscription_form_main_diagnosis"
                           required=""
                           placeholder="<?= TRANSLATE['DIAGNOSIS'][LANG] ?>">
                    <input type="text" class="input_text full_size mb-10 border"
                           id="subscription_form_main_city"
                           placeholder="<?= TRANSLATE['CITY'][LANG] ?>">
                    <select class="input_text full_size border mb-5 color_gray"
                            id="subscription_form_main_relocate">
                        <option><?= TRANSLATE['RELOCATE'][LANG] ?></option>
                        <option><?= TRANSLATE['YES'][LANG] ?></option>
                        <option><?= TRANSLATE['NO'][LANG] ?></option>
                    </select>
                    <div class="checkbox_wrapper justify-left">
                        <div class="form_checkbox">
                            <div class="custom_checkbox border_gradient">
                                <span class="checkbox_body form_checkbox_confirm"
                                      id="subscription_form_main_confirm"
                                ></span>
                            </div>
                            <p>
                                <a href="https://luckytrials.com/uploads/Zgoda-na-obrobku-PD.pdf" target="_blank">
                                    <?= TRANSLATE['CONFIRM'][LANG]; ?>
                                </a>
                            </p>
                        </div>
                    </div>
                    <input type="submit" class="btn_submit" value="<?= TRANSLATE['SEND'][LANG]; ?>" >
                </form>
            </div>
        </div>
    </div>
</section>