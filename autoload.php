<?php
/**
 * 注册自动加载方法。这里的加载机制是将命名空间和类简单地对应到当前目录的php文件。例如：
 * 加载的类名称是"\Test\Example\MainClass"，那么加载的文件是"Test/Example/MainClass.php"。
 * 加载文件是以这个注册函数所在目录作为根目录，加载类名称和大小写完全保留原状不做处理。
 *
 * @author az13js <1654602334@qq.com>
 */
spl_autoload_register(function($class) {
    $ds = DIRECTORY_SEPARATOR;
    $path = explode('\\', $class . '.php');
    require_once __DIR__ . $ds . implode($ds, $path);
});
