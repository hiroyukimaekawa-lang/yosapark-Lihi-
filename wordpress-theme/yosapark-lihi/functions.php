<?php
/**
 * Theme functions for yosapark Lihi.
 */

if (!defined('ABSPATH')) {
    exit;
}

function lihi_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('script', 'style'));
}
add_action('after_setup_theme', 'lihi_theme_setup');

function lihi_enqueue_assets()
{
    wp_enqueue_style(
        'lihi-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,500;1,600&family=Lato:wght@400;700&family=Noto+Sans+JP:wght@400;500;700&family=Noto+Serif+JP:wght@400;600;700&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'lihi-style',
        get_stylesheet_uri(),
        array('lihi-google-fonts'),
        wp_get_theme()->get('Version')
    );

    wp_enqueue_script(
        'lihi-script',
        get_template_directory_uri() . '/script.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'lihi_enqueue_assets');

function lihi_asset_url($path)
{
    return get_template_directory_uri() . '/' . ltrim($path, '/');
}

function lihi_service_defaults()
{
    return array(
        'lead' => '身体の内側から整える、3つのアプローチ',
        'services' => array(
            1 => array(
                'class' => '',
                'image_class' => '',
                'image' => 'images/4330dc53-9555-4525-8906-9bff88263455.png',
                'image_alt' => '水素ハーブ蒸し ルルオン 施術中',
                'tag' => '人気No.1',
                'title' => '水素ハーブ蒸し',
                'title_accent' => '「ルルオン」',
                'description' => '従来の水素ハーブ蒸しをさらに進化させた「ルルオン」は、ハーブの蒸気が全身を芯から温め、基礎代謝の向上と老廃物の排出を効率よく促進します。冷え・むくみ・ホルモンバランスの乱れにも効果的です。',
                'effects' => array('基礎代謝アップ', '冷え・むくみ改善', 'フェムケア・妊活サポート', 'デトックス効果'),
                'sub_image' => 'images/product_luluonn_herb_ingredients_circle.jpg',
                'sub_image_alt' => 'LULUONNオリジナルハーブ 11種配合',
                'sub_image_mode' => 'after',
            ),
            2 => array(
                'class' => 'service__item--reverse',
                'image_class' => '',
                'image' => 'images/service_lymph_massage_back_full.jpg',
                'image_alt' => 'リンパマッサージ 施術中',
                'tag' => '',
                'title' => 'リンパマッサージ',
                'title_accent' => '',
                'description' => '25年の病院勤務で培った医療知識をもとにした、本格的なリンパドレナージュ。老廃物・余分な水分の排出を促し、むくみの解消と脂肪燃焼をサポート。水素ハーブ蒸しとのW施術でさらに高い効果を発揮します。',
                'effects' => array('むくみ解消', '脂肪燃焼促進', '血行促進', '疲労回復'),
                'sub_image' => '',
                'sub_image_alt' => '',
                'sub_image_mode' => '',
            ),
            3 => array(
                'class' => 'service__item--hydrogen',
                'image_class' => 'service__item-image--hydrogen',
                'image' => 'images/suisokyunyu-new.jpeg',
                'image_alt' => '水素酸素吸入',
                'tag' => '新メニュー',
                'title' => '水素酸素吸入',
                'title_accent' => '＆ 水素ハーブ蒸し',
                'description' => '高濃度の水素と酸素を吸入しながら施術を受けることで、体内の活性酸素を除去。抗酸化作用により細胞レベルから身体を整え、アンチエイジングと代謝向上を同時にアプローチします。',
                'effects' => array('活性酸素除去', 'アンチエイジング', '代謝向上', '疲労・ストレス軽減'),
                'sub_image' => 'images/kikai-large.jpeg',
                'sub_image_alt' => '水素酸素吸入機器',
                'sub_image_mode' => 'wrap',
            ),
        ),
        'courses_title' => 'コース紹介と料金',
        'courses' => array(
            1 => array(
                'badge' => '初回限定',
                'name' => "【人気No.1】短期間で痩せたい方！\n代謝アップ水素まみれコース",
                'description' => '',
                'time' => '120分',
                'original_price' => '14,800円相当',
                'price' => '9,800円',
            ),
            2 => array(
                'badge' => '初回限定',
                'name' => '水素ハーブ蒸し体験コース',
                'description' => '',
                'time' => '90分',
                'original_price' => '',
                'price' => '5,000円',
            ),
            3 => array(
                'badge' => '',
                'name' => 'プレミアムコース',
                'description' => '',
                'time' => '120分',
                'original_price' => '',
                'price' => '8,800円',
            ),
            4 => array(
                'badge' => '',
                'name' => '下半身集中スリムコース',
                'description' => '',
                'time' => '90分',
                'original_price' => '',
                'price' => '8,000円',
            ),
            5 => array(
                'badge' => '',
                'name' => 'フェム温活巡りケアコース',
                'description' => '〜冷え・むくみ・女性ホルモンを整える〜',
                'time' => '100分',
                'original_price' => '',
                'price' => '10,000円',
            ),
        ),
    );
}

function lihi_get_acf_post_id()
{
    $post_id = get_queried_object_id();

    if (!$post_id && is_front_page()) {
        $post_id = (int) get_option('page_on_front');
    }

    return $post_id ?: false;
}

function lihi_get_field_value($name, $default = '')
{
    if (!function_exists('get_field')) {
        return $default;
    }

    $value = get_field($name, lihi_get_acf_post_id());
    if ($value === null || $value === false || $value === '') {
        return $default;
    }

    return $value;
}

function lihi_get_image_url($name, $fallback_path)
{
    $image = lihi_get_field_value($name, '');

    if (is_array($image) && !empty($image['url'])) {
        return $image['url'];
    }

    if (is_numeric($image)) {
        $url = wp_get_attachment_image_url((int) $image, 'full');
        if ($url) {
            return $url;
        }
    }

    if (is_string($image) && $image !== '') {
        return $image;
    }

    return $fallback_path ? lihi_asset_url($fallback_path) : '';
}

function lihi_get_lines_field($name, array $default)
{
    $value = lihi_get_field_value($name, '');
    if ($value === '') {
        return $default;
    }

    $lines = preg_split('/\R/u', (string) $value);
    $lines = array_values(array_filter(array_map('trim', $lines)));

    return $lines ?: $default;
}

function lihi_text_with_breaks($text)
{
    return nl2br(esc_html((string) $text), false);
}

function lihi_register_service_acf_fields()
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    $defaults = lihi_service_defaults();
    $fields = array(
        array(
            'key' => 'field_lihi_service_lead',
            'label' => 'サービス リード文',
            'name' => 'lihi_service_lead',
            'type' => 'text',
            'default_value' => $defaults['lead'],
        ),
    );

    foreach ($defaults['services'] as $number => $service) {
        $fields[] = array(
            'key' => 'field_lihi_service_' . $number . '_tab',
            'label' => 'サービス ' . $number,
            'type' => 'tab',
            'placement' => 'top',
        );
        $fields[] = array(
            'key' => 'field_lihi_service_' . $number . '_image',
            'label' => 'メイン画像',
            'name' => 'lihi_service_' . $number . '_image',
            'type' => 'image',
            'return_format' => 'array',
            'preview_size' => 'medium',
        );
        $fields[] = array(
            'key' => 'field_lihi_service_' . $number . '_image_alt',
            'label' => 'メイン画像 alt',
            'name' => 'lihi_service_' . $number . '_image_alt',
            'type' => 'text',
            'default_value' => $service['image_alt'],
        );
        $fields[] = array(
            'key' => 'field_lihi_service_' . $number . '_tag',
            'label' => 'タグ',
            'name' => 'lihi_service_' . $number . '_tag',
            'type' => 'text',
            'default_value' => $service['tag'],
        );
        $fields[] = array(
            'key' => 'field_lihi_service_' . $number . '_title',
            'label' => 'タイトル',
            'name' => 'lihi_service_' . $number . '_title',
            'type' => 'textarea',
            'rows' => 2,
            'new_lines' => '',
            'default_value' => $service['title'],
        );
        $fields[] = array(
            'key' => 'field_lihi_service_' . $number . '_title_accent',
            'label' => 'タイトル強調',
            'name' => 'lihi_service_' . $number . '_title_accent',
            'type' => 'text',
            'default_value' => $service['title_accent'],
        );
        $fields[] = array(
            'key' => 'field_lihi_service_' . $number . '_description',
            'label' => '説明文',
            'name' => 'lihi_service_' . $number . '_description',
            'type' => 'textarea',
            'rows' => 4,
            'new_lines' => '',
            'default_value' => $service['description'],
        );
        $fields[] = array(
            'key' => 'field_lihi_service_' . $number . '_effects',
            'label' => '効果リスト',
            'name' => 'lihi_service_' . $number . '_effects',
            'type' => 'textarea',
            'instructions' => '1行につき1項目を入力してください。',
            'rows' => 4,
            'new_lines' => '',
            'default_value' => implode("\n", $service['effects']),
        );
        $fields[] = array(
            'key' => 'field_lihi_service_' . $number . '_sub_image',
            'label' => 'サブ画像',
            'name' => 'lihi_service_' . $number . '_sub_image',
            'type' => 'image',
            'return_format' => 'array',
            'preview_size' => 'medium',
        );
        $fields[] = array(
            'key' => 'field_lihi_service_' . $number . '_sub_image_alt',
            'label' => 'サブ画像 alt',
            'name' => 'lihi_service_' . $number . '_sub_image_alt',
            'type' => 'text',
            'default_value' => $service['sub_image_alt'],
        );
    }

    $fields[] = array(
        'key' => 'field_lihi_courses_tab',
        'label' => 'コース',
        'type' => 'tab',
        'placement' => 'top',
    );
    $fields[] = array(
        'key' => 'field_lihi_courses_title',
        'label' => 'コース見出し',
        'name' => 'lihi_service_courses_title',
        'type' => 'text',
        'default_value' => $defaults['courses_title'],
    );

    foreach ($defaults['courses'] as $number => $course) {
        $fields[] = array(
            'key' => 'field_lihi_course_' . $number . '_badge',
            'label' => 'コース' . $number . ' バッジ',
            'name' => 'lihi_course_' . $number . '_badge',
            'type' => 'text',
            'default_value' => $course['badge'],
        );
        $fields[] = array(
            'key' => 'field_lihi_course_' . $number . '_name',
            'label' => 'コース' . $number . ' 名',
            'name' => 'lihi_course_' . $number . '_name',
            'type' => 'textarea',
            'rows' => 2,
            'new_lines' => '',
            'default_value' => $course['name'],
        );
        $fields[] = array(
            'key' => 'field_lihi_course_' . $number . '_description',
            'label' => 'コース' . $number . ' 補足',
            'name' => 'lihi_course_' . $number . '_description',
            'type' => 'textarea',
            'rows' => 2,
            'new_lines' => '',
            'default_value' => $course['description'],
        );
        $fields[] = array(
            'key' => 'field_lihi_course_' . $number . '_time',
            'label' => 'コース' . $number . ' 時間',
            'name' => 'lihi_course_' . $number . '_time',
            'type' => 'text',
            'default_value' => $course['time'],
        );
        $fields[] = array(
            'key' => 'field_lihi_course_' . $number . '_original_price',
            'label' => 'コース' . $number . ' 通常価格',
            'name' => 'lihi_course_' . $number . '_original_price',
            'type' => 'text',
            'default_value' => $course['original_price'],
        );
        $fields[] = array(
            'key' => 'field_lihi_course_' . $number . '_price',
            'label' => 'コース' . $number . ' 価格',
            'name' => 'lihi_course_' . $number . '_price',
            'type' => 'text',
            'default_value' => $course['price'],
        );
    }

    acf_add_local_field_group(array(
        'key' => 'group_lihi_service_section',
        'title' => 'サービスセクション',
        'fields' => $fields,
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));
}
add_action('acf/init', 'lihi_register_service_acf_fields');

function lihi_render_service_title($title, $accent)
{
    echo lihi_text_with_breaks($title);
    if ($accent !== '') {
        echo '<br><em>' . esc_html($accent) . '</em>';
    }
}

function lihi_render_service_effects(array $effects)
{
    echo '<ul class="service__item-effects">';
    foreach ($effects as $effect) {
        echo '<li>' . esc_html($effect) . '</li>';
    }
    echo '</ul>';
}

function lihi_render_service_sub_image($url, $alt)
{
    if (!$url) {
        return;
    }

    echo '<div class="service__item-sub-image">';
    echo '<img src="' . esc_url($url) . '" alt="' . esc_attr($alt) . '" loading="lazy">';
    echo '</div>';
}

function lihi_render_service_section()
{
    $defaults = lihi_service_defaults();
    $lead = lihi_get_field_value('lihi_service_lead', $defaults['lead']);
    ?>
    <section class="section service fade-up" id="service" data-section="service">
      <div class="section__inner">
        <div class="section-header fade-up">
          <h2><span class="en">Service</span><span class="ja">サービス</span></h2>
          <p class="section-lead"><?php echo esc_html($lead); ?></p>
        </div>

        <div class="service__list">
          <?php foreach ($defaults['services'] as $number => $service) : ?>
            <?php
            $image_url = lihi_get_image_url('lihi_service_' . $number . '_image', $service['image']);
            $sub_image_url = lihi_get_image_url('lihi_service_' . $number . '_sub_image', $service['sub_image']);
            $tag = lihi_get_field_value('lihi_service_' . $number . '_tag', $service['tag']);
            $title = lihi_get_field_value('lihi_service_' . $number . '_title', $service['title']);
            $title_accent = lihi_get_field_value('lihi_service_' . $number . '_title_accent', $service['title_accent']);
            $description = lihi_get_field_value('lihi_service_' . $number . '_description', $service['description']);
            $effects = lihi_get_lines_field('lihi_service_' . $number . '_effects', $service['effects']);
            $image_alt = lihi_get_field_value('lihi_service_' . $number . '_image_alt', $service['image_alt']);
            $sub_image_alt = lihi_get_field_value('lihi_service_' . $number . '_sub_image_alt', $service['sub_image_alt']);
            $item_class = trim('service__item ' . $service['class'] . ' animate-item');
            $image_class = trim('service__item-image ' . $service['image_class']);
            ?>
            <article class="<?php echo esc_attr($item_class); ?>">
              <div class="<?php echo esc_attr($image_class); ?>">
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" loading="lazy">
                <?php if ($tag !== '') : ?>
                  <span class="service__item-tag"><?php echo esc_html($tag); ?></span>
                <?php endif; ?>
              </div>
              <div class="service__item-body">
                <h3 class="service__item-title"><?php lihi_render_service_title($title, $title_accent); ?></h3>
                <p class="service__item-desc"><?php echo esc_html($description); ?></p>

                <?php if ($service['sub_image_mode'] === 'wrap') : ?>
                  <div class="service__effects-wrap">
                    <?php lihi_render_service_effects($effects); ?>
                    <?php lihi_render_service_sub_image($sub_image_url, $sub_image_alt); ?>
                  </div>
                <?php else : ?>
                  <?php lihi_render_service_effects($effects); ?>
                  <?php if ($service['sub_image_mode'] === 'after') : ?>
                    <?php lihi_render_service_sub_image($sub_image_url, $sub_image_alt); ?>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </article>
          <?php endforeach; ?>
        </div>

        <div class="service__courses">
          <h3 class="service__courses-title"><?php echo esc_html(lihi_get_field_value('lihi_service_courses_title', $defaults['courses_title'])); ?></h3>

          <div class="service__courses-list">
            <?php foreach ($defaults['courses'] as $number => $course) : ?>
              <?php
              $badge = lihi_get_field_value('lihi_course_' . $number . '_badge', $course['badge']);
              $name = lihi_get_field_value('lihi_course_' . $number . '_name', $course['name']);
              $description = lihi_get_field_value('lihi_course_' . $number . '_description', $course['description']);
              $time = lihi_get_field_value('lihi_course_' . $number . '_time', $course['time']);
              $original_price = lihi_get_field_value('lihi_course_' . $number . '_original_price', $course['original_price']);
              $price = lihi_get_field_value('lihi_course_' . $number . '_price', $course['price']);
              $course_class = 'course__item' . ($badge !== '' ? ' course__item--new' : '');
              ?>
              <div class="<?php echo esc_attr($course_class); ?>">
                <?php if ($badge !== '') : ?>
                  <div class="course__badge"><?php echo esc_html($badge); ?></div>
                <?php endif; ?>
                <h4 class="course__name"><?php echo lihi_text_with_breaks($name); ?></h4>
                <?php if ($description !== '') : ?>
                  <p class="course__description"><?php echo esc_html($description); ?></p>
                <?php endif; ?>
                <div class="course__details">
                  <p class="course__time"><?php echo esc_html($time); ?></p>
                  <p class="course__price">
                    <?php if ($original_price !== '' && $price !== '') : ?>
                      <span class="original"><?php echo esc_html($original_price); ?></span> &rarr; <span class="discount"><?php echo esc_html($price); ?></span>
                    <?php else : ?>
                      <?php echo esc_html($price); ?>
                    <?php endif; ?>
                  </p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>
    <?php
}
