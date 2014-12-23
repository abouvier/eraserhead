#!/usr/bin/env php
<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   eraserhead.php                                     :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: abouvier <abouvier@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2013/11/19 12:42:08 by abouvier          #+#    #+#             */
/*   Updated: 2014/12/23 16:17:22 by abouvier         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

const HEADER_CUR = <<<'PLAIN'
/\* \*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\* \*/
/\*                                                                            \*/
/\*                                                        \:\:\:      \:\:\:\:\:\:\:\:   \*/
/\*   ([\w.-]+\s*)\:\+\:      \:\+\:    \:\+\:   \*/
/\*                                                    \+\:\+ \+\:\+         \+\:\+     \*/
/\*   By\: ([\w-]+) \<\2@student\.42\.fr\>\s+\+#\+  \+\:\+       \+#\+        \*/
/\*                                                \+#\+#\+#\+#\+#\+   \+#\+           \*/
/\*   Created\: (\d+/\d+/\d+ \d+\:\d+\:\d+) by \2\s+#\+#    #\+#             \*/
/\*   Updated\: \d+/\d+/\d+ \d+\:\d+\:\d+ by \2\s+###   ########\.fr       \*/
/\*                                                                            \*/
/\* \*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\*\* \*/
PLAIN;

const HEADER_NEW = <<<'PLAIN'
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   %1$-51s:+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: %2$s <%2$s@student.42.fr>%3$s+#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: %4$s by %2$-18s#+#    #+#             */
/*   Updated: %5$s by %2$-17s###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */
PLAIN;

if (!isset($argc) or $argc < 2)
	exit("Usage: $argv[0] src [login]" . PHP_EOL);

if (!is_readable($argv[1]))
	exit("$argv[1]: file not found" . PHP_EOL);

$src = file_get_contents($argv[1]);

if ($argc > 2)
	$login = $argv[2];
elseif (isset($_SERVER['USER']))
	$login = $_SERVER['USER'];
else
	exit("Usage: $argv[0] src login" . PHP_EOL);

$src2 = preg_replace_callback('`' . HEADER_CUR . '`', function ($m) use ($login) {
	$login = substr($login, 0, 8);
	return sprintf(HEADER_NEW, trim($m[1]), $login, str_repeat(' ', 26 - 2 * strlen($login)), $m[3], date('Y/m/d H:i:s', time() - mt_rand(0, 7200)));
}, $src);

if ($src2 == $src)
	exit("$argv[1]: header not found" . PHP_EOL);

if (file_put_contents($argv[1], $src2) !== strlen($src2))
	exit("$argv[1]: update fail" . PHP_EOL);

echo "$argv[1]: updated" . PHP_EOL;
