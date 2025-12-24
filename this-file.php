<?php

// Водяной знак на изображения
function add_watermark_to_image($image_path, $watermark_path)
{
    // Получаем информацию о изображении
    $image_info = getimagesize($image_path);
    $image_type = $image_info[2];

    // Создаем изображение из файла
    if ($image_type == IMAGETYPE_JPEG) {
        $image = imagecreatefromjpeg($image_path);
    } elseif ($image_type == IMAGETYPE_PNG) {
        $image = imagecreatefrompng($image_path);
    } elseif ($image_type == IMAGETYPE_GIF) {
        $image = imagecreatefromgif($image_path);
    } else {
        return false;
    }

    // Создаем водяной знак
    $watermark = imagecreatefrompng($watermark_path);
    $watermark_width = imagesx($watermark);
    $watermark_height = imagesy($watermark);

    // Позиция водяного знака (в данном случае в центре)
    $dest_x = (imagesx($image) - $watermark_width) / 2;
    $dest_y = (imagesy($image) - $watermark_height) / 2;

    // Наложение водяного знака
    imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height);

    // Сохранение изображения с водяным знаком
    if ($image_type == IMAGETYPE_JPEG) {
        imagejpeg($image, $image_path);
    } elseif ($image_type == IMAGETYPE_PNG) {
        imagepng($image, $image_path);
    } elseif ($image_type == IMAGETYPE_GIF) {
        imagegif($image, $image_path);
    }

    // Освобождение памяти
    imagedestroy($image);
    imagedestroy($watermark);

    return true;
}

function add_watermark_to_blog_post_images($metadata, $attachment_id)
{
    // Проверяем, принадлежит ли изображение посту типа 'blog'
    $post_id = wp_get_post_parent_id($attachment_id);
    if ($post_id) {
        $post_type = get_post_type($post_id);
        if ($post_type === 'blog') { // Убедитесь, что тип поста 'blog'
            $upload_dir = wp_upload_dir();
            $image_path = $upload_dir['basedir'] . '/' . $metadata['file'];

            // Путь к водяному знаку
            $watermark_path = get_template_directory() . '/watermark.png'; // Укажите путь к вашему водяному знаку

            // Добавляем водяной знак к основному изображению
            add_watermark_to_image($image_path, $watermark_path);

            // Добавляем водяной знак к миниатюрам
            if (isset($metadata['sizes'])) {
                foreach ($metadata['sizes'] as $size) {
                    $thumbnail_path = $upload_dir['path'] . '/' . $size['file'];
                    add_watermark_to_image($thumbnail_path, $watermark_path);
                }
            }
        }
    }

    return $metadata;
}
add_filter('wp_generate_attachment_metadata', 'add_watermark_to_blog_post_images', 10, 2);

function add_watermark_to_existing_blog_post_images()
{
    // Получаем все посты типа 'blog'
    $args = array(
        'post_type' => 'blog',
        'posts_per_page' => -1,
    );
    $blog_posts = get_posts($args);

    // Путь к водяному знаку
    $watermark_path = get_template_directory() . '/watermark.png'; // Укажите путь к вашему водяному знаку

    foreach ($blog_posts as $post) {
        // Получаем ID миниатюры поста
        $thumbnail_id = get_post_thumbnail_id($post->ID);
        if ($thumbnail_id) {
            // Получаем метаданные изображения
            $metadata = wp_get_attachment_metadata($thumbnail_id);
            if ($metadata) {
                $upload_dir = wp_upload_dir();
                $image_path = $upload_dir['basedir'] . '/' . $metadata['file'];

                // Добавляем водяной знак к основному изображению
                add_watermark_to_image($image_path, $watermark_path);

                // Добавляем водяной знак к миниатюрам
                if (isset($metadata['sizes'])) {
                    foreach ($metadata['sizes'] as $size) {
                        $thumbnail_path = $upload_dir['path'] . '/' . $size['file'];
                        add_watermark_to_image($thumbnail_path, $watermark_path);
                    }
                }
            }
        }
    }
}

// Вызов функции для обработки уже загруженных изображений
add_watermark_to_existing_blog_post_images();







// Загрузка изображений на яндекс облако
// Прогрузка файлов на яндекс облако, а не в медиафайлы вордпресса uploads

// 1. Подготовка Yandex Object Storage
// Создание бакета:
// - Зарегистрируйтесь в Yandex Cloud.
// - Перейдите в Облачные сервисы → Object Storage.
// - Создайте бакет с именем, например, my-wordpress-bucket.
// - Разрешите публичный доступ, если файлы должны быть доступны по URL.

// Создание сервисного аккаунта и ключей:
// - Перейдите в IAM & Access Management → Сервисные аккаунты.
// - Создайте сервисный аккаунт с именем wordpress-storage.
// - Добавьте роль storage.editor.
// - Создайте статические ключи (Access Key и Secret Key) для авторизации.

// 2. Установка AWS SDK в WordPress
// Способ 1: Установка через Composer (рекомендуется):
// - Выполните команду в консоли: composer require aws/aws-sdk-php.
// - Этот метод автоматически подтянет все зависимости.

// Способ 2: Ручная установка:
// - Скачайте AWS SDK для PHP.
// - Распакуйте в wp-content/plugins/aws-sdk/ или wp-includes/aws-sdk/.
// - Подключите SDK в коде с помощью require_once.

// Пример кода для ручной установки:
require_once ABSPATH . 'wp-includes/aws-sdk/aws-autoloader.php';

// 3. Код загрузки файлов в Yandex Object Storage
// Создадим функцию загрузки файла в бакет и подключим ее к WordPress-ху.

require 'vendor/autoload.php'; // Подключаем AWS SDK

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// Функция загрузки файла в Yandex Storage
function upload_to_yandex_storage($file_path, $file_name)
{
    $s3 = new S3Client([
        'version'     => 'latest',
        'region'      => 'ru-central1',
        'endpoint'    => 'https://storage.yandexcloud.net',
        'credentials' => [
            'key'    => 'ВАШ_ACCESS_KEY',
            'secret' => 'ВАШ_SECRET_KEY',
        ],
    ]);

    try {
        $result = $s3->putObject([
            'Bucket' => 'my-wordpress-bucket',
            'Key'    => 'uploads/' . $file_name,
            'Body'   => fopen($file_path, 'r'),
            'ACL'    => 'public-read', // Делаем файл публичным
        ]);
        return $result['ObjectURL']; // Возвращаем URL загруженного файла
    } catch (AwsException $e) {
        error_log('Ошибка загрузки в Yandex Storage: ' . $e->getMessage());
        return false;
    }
}

// 4. Интеграция с загрузкой файлов в WordPress
// Теперь нужно отправлять файлы в Yandex Storage при загрузке в Медиафайлы.

function handle_upload_to_yandex($metadata, $attachment_id)
{
    $file_path = get_attached_file($attachment_id);
    $file_name = basename($file_path);

    // Загружаем файл в Yandex Storage
    $yandex_url = upload_to_yandex_storage($file_path, $file_name);

    if ($yandex_url) {
        // Сохраняем новый URL в базе данных
        update_post_meta($attachment_id, '_yandex_storage_url', $yandex_url);

        // Удаляем локальную копию (необязательно)
        @unlink($file_path);
    }

    return $metadata;
}
add_filter('wp_generate_attachment_metadata', 'handle_upload_to_yandex', 10, 2);

// 5. Отображение изображений с Yandex Storage
// Чтобы загруженные изображения корректно отображались в WordPress, используем wp_get_attachment_url:

function get_yandex_attachment_url($url, $post_id)
{
    $yandex_url = get_post_meta($post_id, '_yandex_storage_url', true);
    return $yandex_url ? $yandex_url : $url;
}
add_filter('wp_get_attachment_url', 'get_yandex_attachment_url', 10, 2);

// 6. Оптимизация и кеширование
// Если файлов много, можно:
// - Настроить CDN (например, Yandex CDN для ускоренной доставки).
// - Включить кеширование URL в WordPress.
// - Использовать фоновые задачи (wp_cron) для загрузки, чтобы не замедлять работу админки.

// Что получилось?
// - Загружаем файлы прямо в Yandex Object Storage.
// - Сохраняем URL загруженного файла в метаполе _yandex_storage_url.
// - Автоматически подменяем ссылки на файлы в WordPress.
// - Локальные копии можно удалять после загрузки в облако.
// Этот метод избавляет сервер от нагрузки, так как файлы хранятся в облаке, а не в папке uploads.










// Автосжатие видоса пример через ffmpeg
function compress_video_on_upload($file)
{
    if (strpos($file['type'], 'video/') === 0) {
        $output = shell_exec("/usr/local/bin/ffmpeg -i {$file['tmp_name']} -vcodec libx264 -crf 23 -preset fast {$file['tmp_name']}_compressed.mp4 2>&1");
        if (file_exists("{$file['tmp_name']}_compressed.mp4")) {
            unlink($file['tmp_name']);
            rename("{$file['tmp_name']}_compressed.mp4", $file['tmp_name']);
        } else {
            error_log("FFmpeg error: " . $output);
        }
    }
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'compress_video_on_upload');
