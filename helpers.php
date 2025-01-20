<?php

/**
 * Get a path and return the absolute path
 *
 * @param string $path
 * @return string
 */
function basePath($path)
{

    return __DIR__ . '/' . $path;
}

/**
 * Load view
 *
 * @param string $name
 * @return void
 */
function loadView($name)
{
    $viewPath =  basePath("views/$name.view.php");

    if (file_exists($viewPath)) {
        require $viewPath;
    } else {
        echo "The path $name doesnt exist !";
    }
}

/**
 * Load partial
 *
 * @param string $name
 * @return void
 */
function loadPartial($name)
{
    $partialPath = basePath("views/partials/$name.php");

    if (file_exists($partialPath)) {
        require $partialPath;
    } else {
        echo "The path $name doesnt exist !";
    }
}

/**
 * Inspect
 *
 * @param mixed $value
 * @return void
 */
function inspect($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

/**
 * Inspect and die
 *
 * @param mixed $value
 * @return void
 */
function inspectAndDie($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}
