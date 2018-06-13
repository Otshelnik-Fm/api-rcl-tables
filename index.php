<?php

/*

╔═╗╔╦╗╔═╗╔╦╗
║ ║ ║ ╠╣ ║║║ https://otshelnik-fm.ru
╚═╝ ╩ ╚  ╩ ╩

*/

// философия таблиц https://habr.com/post/312422/



function api_tables_resource() {
    rcl_enqueue_style('api_tables',rcl_addon_url('api-table.css', __FILE__));
    rcl_enqueue_style('api_tables-fix',rcl_addon_url('api-dop-fix.css', __FILE__)); // доп стили коррекции. пример. Это не в ядро
}
add_action('rcl_enqueue_scripts','api_tables_resource',10);



/* Класс сборки таблицы


$args['cell'] = '10-30-60';         // структура таблицы - по нему в строках ячейки автоматом получают нужный класс (rcl-table__cell-w-10, rcl-table__cell-w-30, rcl-table__cell-w-60 соответственно). Причем ячейки и в шапке и обычные ячейки
$args['table-border'] = 1;          // true если надо обводить её. Назначится класс rcl-table__border. По умолчанию нет (или да???)
$args['table-border-right'] = 1;    // true если надо ячейки разделять справа бордером. Назначится класс rcl-table__border-row-right
$args['table-border-bottom'] = 1;   // true если надо строки разделять снизу бордером. Назначится класс rcl-table__border-row-bottom
$args['table-zebra'] = 1;           // true если строки стилизовать "зеброй". Назначится класс rcl-table__zebra


Колонка (ячейка) может принимать:
- выравнивание ячейки по центру rcl-table__cell-center
- выравнивание ее по правому краю rcl-table__cell-right
надо в массиве $args завести значения и передавать их туда.
Например $args['cell-2'] = 'center'; -  она назначит 2й колонке класс rcl-table__cell-center

если таблица будет иметь шапку - то в каждую ячейку оттуда назначать data-атрибут data-rcl-ttitle
 - он нам понадобится для показа в адаптиве (на 768 пикселях)


Главный див также получает класс rcl-table__type-cell-2 (где 2 - кол-во колонок в таблице) - сейчас он не используется
- но может пригодится кому для кастомизации



Адаптив отрабатывает от 768 пикселей. Я сделал 50 на 50 соотношение (flex-basis: 50%;) колонка слева (значение из header) к колонке справа
 - но если в частном случае надо для адаптива левую часть сделать меньше - то это уже частный случай. Чтобы нам не зарыться в правилах - так и сделал

по сути весь адаптив строится от наличия шапки. Если шапки нет - адаптив настраивается строго под задачу. Не ядром таблиц


 */

// генерация шапки
// генерация строки
// отправка всего этого на генерацию таблицы







function vdss_table_2(){
  echo '<br/>';
    echo '<h2>Таблицы:</h2>';

    echo 'Здесь будут собраны типовые таблицы: 2,3,4,5 колонок<br>';
    echo 'Как показала практика - большинство задач ими решается<br><br>';


    echo '<h4>2 колонки:</h4>';

    echo '<strong>30% - 70%</strong><br>Первой колонке ширина <strong>rcl-table__cell-w-30</strong>, второй <strong>rcl-table__cell-w-70</strong> - такая простая математика<br><br>';
    echo 'Модификаторы задаются в первом div-е<br><br>';

echo 'Структура:
<pre>
&lt;div class=&quot;rcl-table rcl-table__type-cell-2&quot;&gt;
    &lt;div class=&quot;rcl-table__row rcl-table__row-header&quot;&gt;
        &lt;div class=&quot;rcl-table__cell rcl-table__cell-w-30&quot;&gt;Fund&lt;/div&gt;
        &lt;div class=&quot;rcl-table__cell rcl-table__cell-w-70&quot;&gt;Units&lt;/div&gt;
    &lt;/div&gt;

    &lt;div class=&quot;rcl-table__row&quot;&gt;
        &lt;div class=&quot;rcl-table__cell rcl-table__cell-w-30&quot; data-rcl-ttitle=&quot;Fund&quot;&gt;Apple&lt;/div&gt;
        &lt;div class=&quot;rcl-table__cell rcl-table__cell-w-70&quot; data-rcl-ttitle=&quot;Units&quot;&gt;24,000&lt;/div&gt;
    &lt;/div&gt;

    &lt;div class=&quot;rcl-table__row&quot;&gt;
        &lt;div class=&quot;rcl-table__cell rcl-table__cell-w-30&quot; data-rcl-ttitle=&quot;Fund&quot;&gt;Strawbery&lt;/div&gt;
        &lt;div class=&quot;rcl-table__cell rcl-table__cell-w-70&quot; data-rcl-ttitle=&quot;Units&quot;&gt;4,000&lt;/div&gt;
    &lt;/div&gt;

    &lt;div class=&quot;rcl-table__row&quot;&gt;
        &lt;div class=&quot;rcl-table__cell rcl-table__cell-w-30&quot; data-rcl-ttitle=&quot;Fund&quot;&gt;Banana&lt;/div&gt;
        &lt;div class=&quot;rcl-table__cell rcl-table__cell-w-70&quot; data-rcl-ttitle=&quot;Units&quot;&gt;621,000&lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
</pre><br>
';

echo 'Результат:<br>
<div class="rcl-table rcl-table__type-cell-2">
    <div class="rcl-table__row rcl-table__row-header">
        <div class="rcl-table__cell rcl-table__cell-w-30">Fund</div>
        <div class="rcl-table__cell rcl-table__cell-w-70">Units</div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Fund">Apple</div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Units">24,000</div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Fund">Strawbery</div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Units">4,000</div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Fund">Banana</div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Units">621,000</div>
    </div>
</div>
';


echo '<br><br><br>';
    echo '<h5>Модификаторы:</h5>';
echo 'Добавил обводку таблице<br>Класс: <strong>rcl-table__border</strong><br><br>';

echo '
<div class="rcl-table rcl-table__border rcl-table__type-cell-2">
    <div class="rcl-table__row rcl-table__row-header">
        <div class="rcl-table__cell rcl-table__cell-w-30">Fund</div>
        <div class="rcl-table__cell rcl-table__cell-w-70">Units</div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Fund">Apple</div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Units">24,000</div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Fund">Strawbery</div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Units">4,000</div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Fund">Banana</div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Units">621,000</div>
    </div>
</div>
';



echo '<br><br><br>';
echo 'Обводка таблице и бордер справа<br>Класс: <strong>rcl-table__border</strong> и <strong>rcl-table__border-row-right</strong><br><br>';

echo '
<div class="rcl-table rcl-table__border rcl-table__border-row-right rcl-table__type-cell-2">
    <div class="rcl-table__row rcl-table__row-header">
        <div class="rcl-table__cell rcl-table__cell-w-30">Fund</div>
        <div class="rcl-table__cell rcl-table__cell-w-70">Units</div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Fund">Apple</div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Units">24,000</div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Fund">Strawbery</div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Units">4,000</div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Fund">Banana</div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Units">621,000</div>
    </div>
</div>
';



echo '<br><br><br>';
echo 'Обводка таблице, бордер справа и бордер снизу<br>Класс: <strong>rcl-table__border</strong> и <strong>rcl-table__border-row-right</strong> и <strong>rcl-table__border-row-bottom</strong><br><br>';

echo '
<div class="rcl-table rcl-table__border rcl-table__border-row-right rcl-table__border-row-bottom rcl-table__type-cell-2">
    <div class="rcl-table__row rcl-table__row-header">
        <div class="rcl-table__cell rcl-table__cell-w-30">Fund</div>
        <div class="rcl-table__cell rcl-table__cell-w-70">Units</div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Fund">Apple</div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Units">24,000</div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Fund">Strawbery</div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Units">4,000</div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Fund">Banana</div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Units">621,000</div>
    </div>
</div>
';


echo '<br><br><br>';
echo 'Зебра, обводка таблице, бордер справа и бордер снизу<br>Класс: <strong>rcl-table__zebra</strong> и <strong>rcl-table__border</strong> и <strong>rcl-table__border-row-right</strong> и <strong>rcl-table__border-row-bottom</strong><br><br>';

echo '
<div class="rcl-table rcl-table__zebra rcl-table__border rcl-table__border-row-right rcl-table__border-row-bottom rcl-table__type-cell-2">
    <div class="rcl-table__row rcl-table__row-header">
        <div class="rcl-table__cell rcl-table__cell-w-30">Fund</div>
        <div class="rcl-table__cell rcl-table__cell-w-70">Units</div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Fund">Apple</div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Units">24,000</div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Fund">Strawbery</div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Units">4,000</div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Fund">Banana</div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Units">621,000</div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Fund">Lime</div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Units">1739,000</div>
    </div>
</div>
';


echo '<br><br>';

    echo '<strong>90% - 10%</strong><br>Пример: закладки. Шапки нет<br><br>';

echo '
<div class="rcl-table rcl-table__border-row-bottom rcl-table__type-cell-2">

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-90">
            <a group="77" class="name-bookmarks" href="/post-group/prokachivaem-svoj-recallbar-razbiraemsya-v-ego-shablone-nastraivaem-i-vynosim/"><i class="fa fa-bookmark"></i>Прокачиваем свой RecallBar — разбираемся в его шаблоне, настраиваем и выносим </a>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10">
            <a href="#" class="delete-bookmark floatright" id="bkm-del-783" title="удалить"><i class="fa fa-trash"></i></a>
            <a href="#" class="edit-bookmark floatright" title="редактировать" id="bkm-edit-783"><i class="fa fa-cog"></i></a>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-90">
            <a group="77" class="name-bookmarks" href="/obshhie-svedeniya-o-dopolneniyax-wp-recall/"><i class="fa fa-bookmark"></i>Общие сведения о дополнениях Wp-Recall </a>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10">
            <a href="#" class="delete-bookmark floatright" id="bkm-del-783" title="удалить"><i class="fa fa-trash"></i></a>
            <a href="#" class="edit-bookmark floatright" title="редактировать" id="bkm-edit-783"><i class="fa fa-cog"></i></a>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-90">
            <a group="77" class="name-bookmarks" href="/post-group/snippety-wp-recall-chtoby-ne-poteryat/"><i class="fa fa-bookmark"></i>Сниппеты Wp-Recall чтобы не потерять </a>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10">
            <a href="#" class="delete-bookmark floatright" id="bkm-del-783" title="удалить"><i class="fa fa-trash"></i></a>
            <a href="#" class="edit-bookmark floatright" title="редактировать" id="bkm-edit-783"><i class="fa fa-cog"></i></a>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-90">
            <a group="77" class="name-bookmarks" href="/post-group/znaete-li-vy-chto-fakty-o-plagine-wp-recall-i-edinaya-baza-dlya-razrabotki-pod-wp-recall/"><i class="fa fa-bookmark"></i>Знаете ли вы что… Факты о плагине WP-Recall и единая база для разработки под WP-Recall </a>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10">
            <a href="#" class="delete-bookmark floatright" id="bkm-del-783" title="удалить"><i class="fa fa-trash"></i></a>
            <a href="#" class="edit-bookmark floatright" title="редактировать" id="bkm-edit-783"><i class="fa fa-cog"></i></a>
        </div>
    </div>

</div>
';



echo '<br><br>';



    echo '<strong>Поля профиля. 30% - 70%. Шапки нет</strong><br>';
    echo 'На стили инпутов не смотрим. В этом примере нам отступы придется добавить отдельно - т.к. этот случай уникальный для данных. Смотрим пример адаптивности<br><br>';

echo '
<div class="rcl-table rcl-table__border rcl-table__type-cell-2">

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30">
            <label><label>День Рождения:</label></label>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70">
            <div id="rcl-field-rcl_birthday" class="rcl-field-input type-date-input"><div class="rcl-field-core"><input class="date-field rcl-datepicker" onclick="rcl_show_datepicker(this);" title="Используйте формат: yyyy-mm-dd" pattern="(\d{4}-\d{2}-\d{2})" name="rcl_birthday" id="rcl_birthday" value="2011-11-02" type="text"></div></div>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30">
            <label><label>Статус:</label></label>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70">
            <div id="rcl-field-description" class="rcl-field-input type-textarea-input"><div class="rcl-field-core"><textarea name="description" maxlength="300" class="textarea-field" id="description" rows="5" cols="50">Везёт тому - кто сам везёт!!</textarea><span class="maxlength">272</span><script>rcl_init_field_maxlength("description");</script></div></div>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30">
            <label><label>Раз два три:</label></label>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70">
            <div id="rcl-field-ch_23" class="rcl-field-input type-dynamic-input"><div class="rcl-field-core"><span class="dynamic-values"><span class="dynamic-value"><input name="ch_23[]" value="1" type="text"><a href="#" onclick="rcl_remove_dynamic_field(this);return false;"><i class="fa fa-minus" aria-hidden="true"></i></a></span><span class="dynamic-value"><input name="ch_23[]" value="2" type="text"><a href="#" onclick="rcl_remove_dynamic_field(this);return false;"><i class="fa fa-minus" aria-hidden="true"></i></a></span><span class="dynamic-value"><input name="ch_23[]" value="333" type="text"><a href="#" onclick="rcl_add_dynamic_field(this);return false;"><i class="fa fa-plus" aria-hidden="true"></i></a></span></span></div></div>
        </div>
    </div>

</div>
';


echo '<br><br>';
echo 'Как видим выше - стандартная таблица требует доп стилей<br>';
echo 'Ниже, я таблице добавил кастомный класс my-custom-profile - зацепимся за него и впишем корректировки:<br>';
echo 'Также мы сами сделаем адаптив:<br><br>';


echo '
<div class="rcl-table rcl-table__border my-custom-profile rcl-table__type-cell-2">

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30">
            <label><label>День Рождения:</label></label>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70">
            <div id="rcl-field-rcl_birthday" class="rcl-field-input type-date-input"><div class="rcl-field-core"><input class="date-field rcl-datepicker" onclick="rcl_show_datepicker(this);" title="Используйте формат: yyyy-mm-dd" pattern="(\d{4}-\d{2}-\d{2})" name="rcl_birthday" id="rcl_birthday" value="2011-11-02" type="text"></div></div>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30">
            <label><label>Статус:</label></label>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70">
            <div id="rcl-field-description" class="rcl-field-input type-textarea-input"><div class="rcl-field-core"><textarea name="description" maxlength="300" class="textarea-field" id="description" rows="5" cols="50">Везёт тому - кто сам везёт!!</textarea><span class="maxlength">272</span><script>rcl_init_field_maxlength("description");</script></div></div>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-30">
            <label><label>Раз два три:</label></label>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70">
            <div id="rcl-field-ch_23" class="rcl-field-input type-dynamic-input"><div class="rcl-field-core"><span class="dynamic-values"><span class="dynamic-value"><input name="ch_23[]" value="1" type="text"><a href="#" onclick="rcl_remove_dynamic_field(this);return false;"><i class="fa fa-minus" aria-hidden="true"></i></a></span><span class="dynamic-value"><input name="ch_23[]" value="2" type="text"><a href="#" onclick="rcl_remove_dynamic_field(this);return false;"><i class="fa fa-minus" aria-hidden="true"></i></a></span><span class="dynamic-value"><input name="ch_23[]" value="333" type="text"><a href="#" onclick="rcl_add_dynamic_field(this);return false;"><i class="fa fa-plus" aria-hidden="true"></i></a></span></span></div></div>
        </div>
    </div>

</div>
';


echo '<br>Я использовал такие стили:
<pre>
.my-custom-profile .rcl-table__row {
    background-color: #fafafa;
    padding: .4em 0;
}
.my-custom-profile .rcl-table__cell:nth-child(1) {
    font-weight: bold;
    max-width: 140px;
}
@media screen and (max-width: 768px) {
    .my-custom-profile .rcl-table__row {
        border: 1px solid #e5e5e5;
        display: block;
        margin: 0 0 .8em;
    }
    .my-custom-profile .rcl-table__cell:nth-child(1) {
        max-width: none;
        padding: .2em .6em;
    }
}
</pre>';

echo '<hr style="margin: 12px 0;">';
echo '<hr style="margin: 12px 0;">';
echo '<hr style="margin: 12px 0;">';
}
add_action('rcl_area_before','vdss_table_2');







function vdss_table_3(){
    echo '<h4>3 колонки:</h4>';
    echo '<strong>Таблица вывода публикаций. 10-70-20</strong> и 1 и 3 колонкам доп класс выравнивания по центру <strong>rcl-table__cell-center</strong><br><br>';


echo '
<div class="rcl-table rcl-table__border rcl-table__border-row-bottom rcl-table__type-cell-3">
    <div class="rcl-table__row rcl-table__row-header">
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center">
            Дата
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70">
            Заголовок
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center">
            Статус
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Дата">
            29.03.18
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Заголовок">
            <div>
                <a target="_blank" href="">Куда вписать мне эти коды!?</a>
                <span title="рейтинг" class="rating-rcl "><span class="rating-null">0</span></span>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Статус">
            <span class="status-publish">опубликован</span>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Дата">
            16.03.18
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Заголовок">
            <div>
                <a target="_blank" href="">Пишем дочернее дополнение для WP-Recall - чат-бот погоды в городе (используя ядро допа AutoBot Cabinet)</a>
                <span title="рейтинг" class="rating-rcl "><span class="rating-minus">-10</span></span>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Статус">
            <span class="status-draft">черновик</span>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Дата">
            28.10.17
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Заголовок">
            <div>
                <a target="_blank" href="">Добрый вечер - это когда так:</a>
                <span title="рейтинг" class="rating-rcl "><span class="rating-plus">5</span></span>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Статус">
            <span class="status-publish">опубликован</span>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Дата">
            28.01.16
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Заголовок">
            <div>
                <a target="_blank" href="">авва</a>
                <span title="рейтинг" class="rating-rcl "><span class="rating-null">0</span></span>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Статус">
            <span class="status-pending">на утверждении</span>
        </div>
    </div>
</div>
';



echo '<br><br>';
echo 'Как видим выше - стандартная таблица требует доп стилей<br>';
echo 'Ниже, я таблице добавил кастомный класс my-custom-publiclist - зацепимся за него и впишем корректировки:<br><br>';

echo '
<div class="rcl-table rcl-table__border rcl-table__border-row-bottom rcl-table__type-cell-3 my-custom-publiclist">
    <div class="rcl-table__row rcl-table__row-header">
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center">
            Дата
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70">
            Заголовок
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center">
            Статус
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Дата">
            29.03.18
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Заголовок">
            <div>
                <a target="_blank" href="">Куда вписать мне эти коды!?</a>
                <span title="рейтинг" class="rating-rcl "><span class="rating-null">0</span></span>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Статус">
            <span class="status-publish">опубликован</span>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Дата">
            16.03.18
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Заголовок">
            <div>
                <a target="_blank" href="">Пишем дочернее дополнение для WP-Recall - чат-бот погоды в городе (используя ядро допа AutoBot Cabinet)</a>
                <span title="рейтинг" class="rating-rcl "><span class="rating-minus">-10</span></span>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Статус">
            <span class="status-draft">черновик</span>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Дата">
            28.10.17
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Заголовок">
            <div>
                <a target="_blank" href="">Добрый вечер - это когда так:</a>
                <span title="рейтинг" class="rating-rcl "><span class="rating-plus">5</span></span>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Статус">
            <span class="status-publish">опубликован</span>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Дата">
            28.01.16
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Заголовок">
            <div>
                <a target="_blank" href="">авва</a>
                <span title="рейтинг" class="rating-rcl "><span class="rating-null">0</span></span>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Статус">
            <span class="status-pending">на утверждении</span>
        </div>
    </div>
</div>
';

echo '<br>Я использовал такие стили:
<pre>
.my-custom-publiclist .rcl-table__cell:nth-child(1) {
    min-width: 74px;
}
.my-custom-publiclist .rcl-table__cell:nth-child(2) > div {
    align-items: center;
    display: flex;
    flex-grow: 1;
    justify-content: space-between;
}
.my-custom-publiclist .rcl-table__cell:nth-child(2) > div > span {
    word-break: initial;
}
</pre>';

echo '<hr style="margin: 12px 0;">';
echo '<hr style="margin: 12px 0;">';
echo '<hr style="margin: 12px 0;">';
}
add_action('rcl_area_before','vdss_table_3');





function vdss_table_4(){
    echo '<h4>4 колонки:</h4>';
    echo '<strong>Таблица вывода баланса. 10-10-10-70</strong> и 2 и 3 колонкам доп класс выравнивания справа <strong>rcl-table__cell-right</strong><br><br>';


echo '
<div class="rcl-table rcl-table__border rcl-table__border-row-bottom rcl-table__type-cell-4">
    <div class="rcl-table__row rcl-table__row-header">
        <div class="rcl-table__cell rcl-table__cell-w-10">
            №
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right">
            Приход / Расход
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right">
            Сумма
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70">
            Комментарий
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-10" data-rcl-ttitle="№">
            2356
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Приход / Расход">
            + 470 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Сумма">
            4181.55 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Комментарий">
            <div>
                <b>2018-04-26 10:56:56</b>
                <span>Пожертвование на развитие "Mobile Sidebar" от Вася Джигарханьнович</span>
            </div>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-10" data-rcl-ttitle="№">
            2357
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Приход / Расход">
            - 1456 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Сумма">
            2181.05 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Комментарий">
            <div>
                <b>2018-04-24 01:56:56</b>
                <span>Вывод средств на счет Webmoney</span>
            </div>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-10" data-rcl-ttitle="№">
            2358
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Приход / Расход">
            + 4370 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Сумма">
            9181.23 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Комментарий">
            <div>
                <b>2018-03-26 10:56:56</b>
                <span>Продление поддержки по товару "Lock Cabinet From Guests" от пользователя Марфа Хусейновна</span>
            </div>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-10" data-rcl-ttitle="№">
            2359
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Приход / Расход">
            + 70 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Сумма">
            1.55 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Комментарий">
            <div>
                <b>2018-01-06 09:23:44</b>
                <span>Оплата товара "Lock Cabinet From Guests" от Анна Королева</span>
            </div>
        </div>
    </div>
</div>
';


echo '<br><br>';
echo 'Как видим выше - стандартная таблица требует доп стилей<br>';
echo 'Ниже, я таблице добавил кастомный класс my-custom-balance - зацепимся за него и впишем корректировки:<br><br>';


echo '
<div class="rcl-table rcl-table__border rcl-table__border-row-bottom rcl-table__type-cell-4 my-custom-balance">
    <div class="rcl-table__row rcl-table__row-header">
        <div class="rcl-table__cell rcl-table__cell-w-10">
            №
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right">
            Приход / Расход
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right">
            Сумма
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70">
            Комментарий
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-10" data-rcl-ttitle="№">
            2356
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Приход / Расход">
            + 470 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Сумма">
            4181.55 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Комментарий">
            <div>
                <b>2018-04-26 10:56:56</b>
                <span>Пожертвование на развитие "Mobile Sidebar" от Вася Джигарханьнович</span>
            </div>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-10" data-rcl-ttitle="№">
            2357
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Приход / Расход">
            - 1456 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Сумма">
            2181.05 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Комментарий">
            <div>
                <b>2018-04-24 01:56:56</b>
                <span>Вывод средств на счет Webmoney</span>
            </div>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-10" data-rcl-ttitle="№">
            2358
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Приход / Расход">
            + 4370 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Сумма">
            9181.23 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Комментарий">
            <div>
                <b>2018-03-26 10:56:56</b>
                <span>Продление поддержки по товару "Lock Cabinet From Guests" от пользователя Марфа Хусейновна</span>
            </div>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-10" data-rcl-ttitle="№">
            2359
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Приход / Расход">
            + 70 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Сумма">
            1.55 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-70" data-rcl-ttitle="Комментарий">
            <div>
                <b>2018-01-06 09:23:44</b>
                <span>Оплата товара "Lock Cabinet From Guests" от Анна Королева</span>
            </div>
        </div>
    </div>
</div>
';


echo '<br>Я использовал такие стили:
<pre>
.my-custom-balance .rcl-table__cell:nth-child(1) {
    min-width: 50px;
}
.my-custom-balance .rcl-table__cell:nth-child(2) {
    min-width: 85px;
}
.my-custom-balance .rcl-table__cell:nth-child(3) {
    min-width: 90px;
}
.my-custom-balance .rcl-table__cell:nth-child(4) > div {
    display: flex;
    flex-direction: column;
}
</pre>';

echo '<hr style="margin: 12px 0;">';
echo '<hr style="margin: 12px 0;">';
echo '<hr style="margin: 12px 0;">';
}
add_action('rcl_area_before','vdss_table_4');



function vdss_table_5(){
    echo '<h4>5 колонок:</h4>';
    echo '<strong>Таблица вывода заказов. 20-30-20-10-20</strong> и 3 колонке доп класс выравнивания по центру <strong>rcl-table__cell-center</strong>, а 4-й и 5-й колонкам класс <strong>rcl-table__cell-right</strong><br><br>';


echo '
<div class="rcl-table rcl-table__border rcl-table__border-row-bottom rcl-table__type-cell-5">
    <div class="rcl-table__row rcl-table__row-header">
        <div class="rcl-table__cell rcl-table__cell-w-20">
            № заказа
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-30">
            Дата заказа
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center">
            Кол-во товара
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right">
            Сумма
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-right">
            Статус заказа
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-20" data-rcl-ttitle="№ заказа">
            <a href="">19890</a>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Дата заказа">
            2018-05-14 16:51:24
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Кол-во товара">
            1
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Сумма">
            0 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-right" data-rcl-ttitle="Статус заказа">
            Отправлен
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-20" data-rcl-ttitle="№ заказа">
            <a href="">19825</a>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Дата заказа">
            2018-04-09 12:52:35
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Кол-во товара">
            32
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Сумма">
            12900 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-right" data-rcl-ttitle="Статус заказа">
            Оплачен
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-20" data-rcl-ttitle="№ заказа">
            <a href="">13435</a>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Дата заказа">
            2017-11-14 01:45:17
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Кол-во товара">
            4
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Сумма">
            643 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-right" data-rcl-ttitle="Статус заказа">
            Корзина
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-20" data-rcl-ttitle="№ заказа">
            <a href="">9629</a>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Дата заказа">
            2016-10-06 14:28:31
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Кол-во товара">
            142
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Сумма">
            86978 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-right" data-rcl-ttitle="Статус заказа">
            Неоплачен
        </div>
    </div>
</div>
';

echo '<br><br>';
echo 'Как видим выше - стандартная таблица требует доп стилей<br>';
echo 'Ниже, я таблице добавил кастомный класс my-custom-orders - зацепимся за него и впишем корректировки:<br><br>';

echo '
<div class="rcl-table my-custom-orders rcl-table__border rcl-table__border-row-bottom rcl-table__type-cell-5">
    <div class="rcl-table__row rcl-table__row-header">
        <div class="rcl-table__cell rcl-table__cell-w-20">
            № заказа
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-30">
            Дата заказа
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center">
            Кол-во товара
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right">
            Сумма
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-right">
            Статус заказа
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-20" data-rcl-ttitle="№ заказа">
            <a href="">19890</a>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Дата заказа">
            2018-05-14 16:51:24
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Кол-во товара">
            1
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Сумма">
            0 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-right" data-rcl-ttitle="Статус заказа">
            Отправлен
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-20" data-rcl-ttitle="№ заказа">
            <a href="">19825</a>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Дата заказа">
            2018-04-09 12:52:35
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Кол-во товара">
            32
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Сумма">
            12900 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-right" data-rcl-ttitle="Статус заказа">
            Оплачен
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-20" data-rcl-ttitle="№ заказа">
            <a href="">13435</a>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Дата заказа">
            2017-11-14 01:45:17
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Кол-во товара">
            4
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Сумма">
            643 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-right" data-rcl-ttitle="Статус заказа">
            Корзина
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-20" data-rcl-ttitle="№ заказа">
            <a href="">9629</a>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-30" data-rcl-ttitle="Дата заказа">
            2016-10-06 14:28:31
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Кол-во товара">
            142
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-right" data-rcl-ttitle="Сумма">
            86978 p
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-right" data-rcl-ttitle="Статус заказа">
            Неоплачен
        </div>
    </div>
</div>
';


echo '<br>Я использовал такие стили:
<pre>
.my-custom-orders .rcl-table__cell:nth-child(1) {
    max-width: 95px;
}
.my-custom-orders .rcl-table__cell:nth-child(4) {
    min-width: 75px;
}
.my-custom-orders .rcl-table__cell:nth-child(5) {
    min-width: 90px;
}
</pre>';

echo '<hr style="margin: 12px 0;">';
echo '<hr style="margin: 12px 0;">';
echo '<hr style="margin: 12px 0;">';
}
add_action('rcl_area_before','vdss_table_5');




function vdss_table_6(){
    echo '<h4>сложная таблица:</h4>';
    echo '<strong>Таблица корзины заказов. 60-10-20-10</strong>. 2,3,4 колонкам доп класс выравнивания по центру <strong>rcl-table__cell-center</strong><br>';
    echo 'Последняя колонка - там схитрим стилями, она должна у нас быть 70-20-10<br><br>';

echo '
<div class="rcl-table rcl-table__border rcl-table__border-row-bottom rcl-table__border-row-right rcl-table__type-cell-4">
    <div class="rcl-table__row rcl-table__row-header">
        <div class="rcl-table__cell rcl-table__cell-w-60">
            Товар
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center">
            Цена
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center">
            Количество
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center">
            Сумма
        </div>

    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-60" data-rcl-ttitle="Товар">
            <div>
                <a href="">Users Filter</a>
                <span class="product-excerpt">создание поискового фильтра для организации поиска пользователей по произвольным полям</span>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Цена">
            <div>
                0 <i class="fa fa-rub"></i>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Количество">
            <div class="quantity-selector">
                <a class="edit-amount add-product" onclick="rcl_cart_add_product(17882,0);return false;" href="#">
                    <i class="fa fa-plus"></i>
                </a>
                <span class="product-amount">1</span>
                <a class="edit-amount remove-product" onclick="rcl_cart_remove_product(17882,0);return false;" href="#">
                    <i class="fa fa-minus"></i>
                </a>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Сумма">
            <div>
                <span class="product-sumprice">0</span>
                <i class="fa fa-rub"></i>
            </div>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-60" data-rcl-ttitle="Товар">
            <div>
                <a href="">Reviews Advance</a>
                <span class="product-excerpt">реализует на сайте гибкую систему отзывов</span>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Цена">
            <div>
                3690 <i class="fa fa-rub"></i>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Количество">
            <div class="quantity-selector">
                <a class="edit-amount add-product" onclick="rcl_cart_add_product(17882,0);return false;" href="#">
                    <i class="fa fa-plus"></i>
                </a>
                <span class="product-amount">10</span>
                <a class="edit-amount remove-product" onclick="rcl_cart_remove_product(17882,0);return false;" href="#">
                    <i class="fa fa-minus"></i>
                </a>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Сумма">
            <div>
                <span class="product-sumprice">36900</span>
                <i class="fa fa-rub"></i>
            </div>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-60" data-rcl-ttitle="Товар">
            <div>
                <a href="">Bot Weather In The City</a>
                <span class="product-excerpt">По команде в чат выводит погоду в заданном городе</span>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Цена">
            <div>
                54 <i class="fa fa-rub"></i>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Количество">
            <div class="quantity-selector">
                <a class="edit-amount add-product" onclick="rcl_cart_add_product(17882,0);return false;" href="#">
                    <i class="fa fa-plus"></i>
                </a>
                <span class="product-amount">1</span>
                <a class="edit-amount remove-product" onclick="rcl_cart_remove_product(17882,0);return false;" href="#">
                    <i class="fa fa-minus"></i>
                </a>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Сумма">
            <div>
                <span class="product-sumprice">54</span>
                <i class="fa fa-rub"></i>
            </div>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-60" data-rcl-ttitle="Товар">
            Итого
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Цена"></div>

        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Количество">
            3
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Сумма">
            <div>
                <span class="rcl-order-price">37440</span>
                <i class="fa fa-rub"></i>
            </div>
        </div>
    </div>
</div>
';

echo '<br><br>';
echo 'Как видим выше - стандартная таблица требует доп стилей<br>';
echo 'Ниже, я таблице добавил кастомный класс my-custom-cart - зацепимся за него и впишем корректировки:<br><br>';


echo '
<div class="rcl-table rcl-table__border rcl-table__border-row-bottom rcl-table__border-row-right my-custom-cart rcl-table__type-cell-4">
    <div class="rcl-table__row rcl-table__row-header">
        <div class="rcl-table__cell rcl-table__cell-w-60">
            Товар
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center">
            Цена
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center">
            Количество
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center">
            Сумма
        </div>

    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-60" data-rcl-ttitle="Товар">
            <div>
                <a href="">Users Filter</a>
                <span class="product-excerpt">создание поискового фильтра для организации поиска пользователей по произвольным полям</span>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Цена">
            <div>
                0 <i class="fa fa-rub"></i>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Количество">
            <div class="quantity-selector">
                <a class="edit-amount add-product" onclick="rcl_cart_add_product(17882,0);return false;" href="#">
                    <i class="fa fa-plus"></i>
                </a>
                <span class="product-amount">1</span>
                <a class="edit-amount remove-product" onclick="rcl_cart_remove_product(17882,0);return false;" href="#">
                    <i class="fa fa-minus"></i>
                </a>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Сумма">
            <div>
                <span class="product-sumprice">0</span>
                <i class="fa fa-rub"></i>
            </div>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-60" data-rcl-ttitle="Товар">
            <div>
                <a href="">Reviews Advance</a>
                <span class="product-excerpt">реализует на сайте гибкую систему отзывов</span>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Цена">
            <div>
                3690 <i class="fa fa-rub"></i>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Количество">
            <div class="quantity-selector">
                <a class="edit-amount add-product" onclick="rcl_cart_add_product(17882,0);return false;" href="#">
                    <i class="fa fa-plus"></i>
                </a>
                <span class="product-amount">10</span>
                <a class="edit-amount remove-product" onclick="rcl_cart_remove_product(17882,0);return false;" href="#">
                    <i class="fa fa-minus"></i>
                </a>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Сумма">
            <div>
                <span class="product-sumprice">36900</span>
                <i class="fa fa-rub"></i>
            </div>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-60" data-rcl-ttitle="Товар">
            <div>
                <a href="">Bot Weather In The City</a>
                <span class="product-excerpt">По команде в чат выводит погоду в заданном городе</span>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Цена">
            <div>
                54 <i class="fa fa-rub"></i>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Количество">
            <div class="quantity-selector">
                <a class="edit-amount add-product" onclick="rcl_cart_add_product(17882,0);return false;" href="#">
                    <i class="fa fa-plus"></i>
                </a>
                <span class="product-amount">1</span>
                <a class="edit-amount remove-product" onclick="rcl_cart_remove_product(17882,0);return false;" href="#">
                    <i class="fa fa-minus"></i>
                </a>
            </div>
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Сумма">
            <div>
                <span class="product-sumprice">54</span>
                <i class="fa fa-rub"></i>
            </div>
        </div>
    </div>

    <div class="rcl-table__row">
        <div class="rcl-table__cell rcl-table__cell-w-60" data-rcl-ttitle="Товар">
            Итого
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Цена"></div>

        <div class="rcl-table__cell rcl-table__cell-w-20 rcl-table__cell-center" data-rcl-ttitle="Количество">
            3
        </div>
        <div class="rcl-table__cell rcl-table__cell-w-10 rcl-table__cell-center" data-rcl-ttitle="Сумма">
            <div>
                <span class="rcl-order-price">37440</span>
                <i class="fa fa-rub"></i>
            </div>
        </div>
    </div>
</div>
';



echo '<br>Я использовал такие стили:
<pre>
.my-custom-cart .rcl-table__cell:nth-child(2),
.my-custom-cart .rcl-table__cell:nth-child(4){
    flex-grow: 0;
    min-width: 5.1em;
}
.my-custom-cart .rcl-table__cell:nth-child(3) {
    flex-shrink: 0;
    max-width: 115px;
    min-width: 7.1em;
    overflow: hidden;
}
.my-custom-cart .rcl-table__cell:nth-child(1) > div {
    display: flex;
    flex-direction: column;
}
.my-custom-cart .rcl-table__row:last-child {
    font-weight: bold;
}
.my-custom-cart .rcl-table__row:last-child .rcl-table__cell:nth-child(1) {
    flex-basis: 70%;
    padding: .8em .6em;
}

@media all and (max-width: 768px) {
    .my-custom-cart .rcl-table__row:last-child .rcl-table__cell:nth-child(1)::before {
        content: "";
    }
    .my-custom-cart .rcl-table__row:last-child .rcl-table__cell:nth-child(1) {
        font-size: 16px;
        padding: 0;
    }
}
</pre>';

echo '<hr style="margin: 12px 0;">';
echo '<hr style="margin: 12px 0;">';
echo '<hr style="margin: 12px 0;">';

}
add_action('rcl_area_before','vdss_table_6');


