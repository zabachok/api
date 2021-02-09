<?php
/**
 * @var $namespace string
 * @var $name string
 * @var $className string
 * @var $fields array
 * @var $labels array
 * @var $forms array
 * @var $types array
 */
?>
<?= '<?php' ?>

namespace zabachok\api\transformers\<?= $namespace ?>;

use zabachok\api\dtos\<?= $namespace ?>\<?= ucfirst($name) ?>Dto;
<?php foreach ($forms as $formName): ?>
use zabachok\api\transformers\<?= $namespace ?>\<?= $formName ?>\<?= ucfirst($formName) ?>Transformer;
<?php endforeach; ?>

class <?= $className ?>
{
    <?php if($forms):?>

<?php foreach ($forms as $formName): ?>
    private <?= ucfirst($formName) ?>Transformer $<?= $formName ?>Transformer;
<?php endforeach; ?>

    public function __construct(
<?php
$key = -1;
$count = count($forms);
foreach ($forms as $formName):
$key++;
    ?>
        <?= ucfirst($formName) ?>Transformer $<?= $formName ?>Transformer<?= $key < $count - 1 ? ',' : '' ?>

<?php endforeach; ?>
    )
    {
<?php foreach ($forms as $formName): ?>
        $this-><?= $formName ?>Transformer = $<?= $formName ?>Transformer;
<?php endforeach; ?>
    }
    <?php endif; ?>

    public function transform(<?= ucfirst($name) ?>Dto $dto): array
    {
        return [
<?php foreach ($fields as $field => $validation): ?>
            '<?= $field ?>' => (<?= $types[$field] ?? 'string' ?>) $dto-><?= $field ?>,
<?php endforeach; ?>
<?php foreach ($forms as $formName): ?>
            '<?= $formName ?>' => $this-><?= $formName ?>Transformer->transform($dto-><?= $formName ?>),
<?php endforeach; ?>
        ];
    }
}
