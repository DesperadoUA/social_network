<?php
foreach($pages as $page) {
	echo "<div class='title_item'>{$page['title']}
              <a href='/admin/static-page/{$page['id']}' 
              class='neon_button'>
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              Редактировать
              </a>
          </div>";
}