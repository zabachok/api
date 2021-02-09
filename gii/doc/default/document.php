<?php

use zabachok\api\doc\generator\form\Generator;

/**
 * @var $generator Generator
 */
?>
# [<?= $generator->title ?>](<?= $generator->getFileName() ?>.md)

Отправляем **<?= $generator->method ?>** на **<?= $generator->url ?>**

### Параметры:

<?= $generator->gridRenderer->render() ?>
<?= $generator->enumsRenderer->render() ?>

### Положительный ответ

Положительный ответ расположен в файле [<?= $generator->getResponseLink() ?>](../../<?= $generator->getResponseLink() ?>.md)
