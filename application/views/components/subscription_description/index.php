<section class="subscription_description">
    <div class="container">
        <div class="row_subscription_description">
            <?php
                foreach ($settings['subscription_description']['images_and_text'] as $item) {
                    echo "<div class='subscription_description_item'>
                            <img src='{$item['src']}' loading='lazy' height='130' width='130'>
                            <p class='subscription_description_item_text'>
                                {$item['description']}
                            </p>
                        </div>";
                }
            ?>
        </div>
    </div>
</section>