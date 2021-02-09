<?php
/**
 * @var $namespace string
 * @var $name string
 * @var $className string
 * @var $fields array
 * @var $labels array
 * @var $forms array
 */
?>
<?= '<?php' ?>

namespace zabachok\api\dtos\<?= $namespace ?>;

<?php foreach ($forms as $formName): ?>
use zabachok\api\dtos\<?= $namespace ?>\<?= $formName ?>\<?= ucfirst($formName) ?>Dto;
<?php endforeach; ?>

class <?= $className ?>

{
<?php foreach ($fields as $field => $validation): ?>
    public $<?= $field ?>;
<?php endforeach; ?>
<?php foreach ($forms as $formName): ?>
    /**
    * @var <?= ucfirst($formName) ?>Dto
    */
    public $<?= $formName ?>;
<?php endforeach; ?>
}
