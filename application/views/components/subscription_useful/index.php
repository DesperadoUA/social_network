<section class="subscription_useful">
    <div class="container">
        <div class="subscription_useful_ttl">
            <?= TRANSLATE['SUBSCRIPTION_USEFUL_TITLE'][LANG]; ?>
        </div>
        <div class="row_subscription_useful">
            <?php
                foreach ($settings['subscription_useful']['images_and_text'] as $item) {
                    echo "<div class='subscription_useful_item'>
                            <img src='{$item['src']}' loading='lazy' height='100' width='100'>
                            <p class='subscription_useful_item_text'>
                                {$item['description']}
                            </p>
                        </div>";
                }
            ?>
        </div>
    </div>
</section>