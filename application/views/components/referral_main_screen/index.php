<section class="referral_main_screen">
    <div class="container">
        <div class="row_referral">
            <div class="referral_main_screen_left">
                <h1><?= $body['content']['h1']; ?></h1>
                <div class="referral_main_screen_des">
					<?= $body['short_desc']; ?>
                </div>
                <div class="row_referral_buttons">
                    <a href="<?= $options['ref']['text'] ?>" target="_blank" class="profile_ad_btn search_btn">
						<?= TRANSLATE['BRING_FRIEND'][LANG] ?>
                    </a>
                </div>
            </div>
            <div class="referral_main_screen_right"></div>
        </div>
    </div>
</section>