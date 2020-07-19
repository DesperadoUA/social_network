<?php
foreach ($users as $user) {
	echo "<p><a href='/blog/{$user['id']}'>{$user['login']}</a></p>";
}