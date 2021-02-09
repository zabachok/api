<?php

namespace zabachok\api\gii\form;

use Yii;
use yii\base\Model;
use yii\gii\CodeFile;
use yii\gii\Generator as GiiGenerator;

class Generator extends GiiGenerator
{
    private $configuration;

    public function getName(): string
    {
        return 'Генерация всего';
    }

    public function generate(): array
    {
        $this->importConfiguration();

        return $this->resolveForm($this->configuration, 'site');
    }

    public function getFileName(): string
    {
        if (!empty($this->name)) {
            return $this->name;
        }

        $elements = explode('\\', $this->class);
        $elements = array_reverse($elements);
        $fileName = str_replace('Form', '', $elements[0]);

        return $elements[1] . '-' . strtolower($fileName);
    }

    private function importConfiguration()
    {
        $this->configuration = require __DIR__ . '/configuration.php';
    }

    private function resolveForm(array $form, string $namespace): array
    {
        $files = [];
        $files[] = new CodeFile(
            Yii::getAlias('@app/forms/' . $namespace . '/' . $form['class'] . 'Form.php'),
            $this->render('form.php', [
                'name' => strtolower($form['class']),
                'className' => $form['class'] . 'Form',
                'fields' => $form['fields'],
                'labels' => $form['labels'],
                'forms' => array_keys($form['forms'] ?? []),
                'namespace' => str_replace('/', '\\', $namespace),
            ])
        );
        $files[] = new CodeFile(
            Yii::getAlias('@app/dtos/' . $namespace . '/' . $form['class'] . 'Dto.php'),
            $this->render('dto.php', [
                'name' => strtolower($form['class']),
                'className' => $form['class'] . 'Dto',
                'fields' => $form['fields'],
                'labels' => $form['labels'],
                'forms' => array_keys($form['forms'] ?? []),
                'namespace' => str_replace('/', '\\', $namespace),
            ])
        );
        $files[] = new CodeFile(
            Yii::getAlias('@app/transformers/' . $namespace . '/' . $form['class'] . 'Transformer.php'),
            $this->render('transformer.php', [
                'name' => strtolower($form['class']),
                'className' => $form['class'] . 'Transformer',
                'fields' => $form['fields'],
                'labels' => $form['labels'],
                'forms' => array_keys($form['forms'] ?? []),
                'namespace' => str_replace('/', '\\', $namespace),
                'types' => $form['types'] ?? [],
            ])
        );
        foreach ($form['forms'] ?? [] as $formName => $form) {
            $files = array_merge($files, $this->resolveForm($form, $namespace . '\\' . $formName));
        }

        return $files;
    }

    public function renderRules(array $fields)
    {
        $lines = [];
        foreach ($fields as $field => $valudators) {
            foreach ($valudators as $valudator) {
                $lines[] = str_repeat("\t", 3) . $this->renderValidator($field, $valudator) . ',' . PHP_EOL;
            }
        }

        return implode('', $lines);
    }

    private function renderValidator(string $field, $validator): string
    {
        $values = [];
        foreach ($validator as $key => $item) {
            if (is_numeric($key)) {
                $values[] = "'" . $item . "'";
            } else {
                $values[] = "'" . $key . "' => " . $this->renderValue($item);
            }
        }

        return "['" . $field . "', " . implode(', ', $values) . "]";
    }

    private function renderValue($value): string
    {
        if (is_string($value)) {
            return "'" . $value . "'";
        }
        if (is_numeric($value)) {
            return $value;
        }
        if (is_array($value)) {
            $result = [];
            foreach ($value as $item) {
                $result[] = $this->renderValue($item);
            }
            return '[' . implode(', ', $result) . ']';
        }

        return '';
    }
}
