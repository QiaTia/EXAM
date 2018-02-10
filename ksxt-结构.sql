-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- 主机: sql113.byethost33.com
-- 生成日期: 2018 年 02 月 10 日 00:09
-- 服务器版本: 5.6.35-81.0
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `b33_20687840_ksxt`
--

-- --------------------------------------------------------

--
-- 表的结构 `checkbox`
--

CREATE TABLE IF NOT EXISTS `checkbox` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `class` text COLLATE utf8_unicode_ci NOT NULL,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `option_1` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `option_2` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `option_3` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `option_4` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `option_5` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `option_6` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `option_7` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `option_8` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `option_9` varchar(240) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- 表的结构 `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` text COLLATE utf8_unicode_ci NOT NULL COMMENT '班级名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `curriculum`
--

CREATE TABLE IF NOT EXISTS `curriculum` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `radio` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `checkbox` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `judge` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `fill` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `saq` mediumint(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `fill`
--

CREATE TABLE IF NOT EXISTS `fill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` text COLLATE utf8_unicode_ci NOT NULL,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `answer_1` text COLLATE utf8_unicode_ci NOT NULL,
  `answer_2` text COLLATE utf8_unicode_ci NOT NULL,
  `answer_3` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- 表的结构 `judge`
--

CREATE TABLE IF NOT EXISTS `judge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` text COLLATE utf8_unicode_ci NOT NULL,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `answer` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- 表的结构 `radio`
--

CREATE TABLE IF NOT EXISTS `radio` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `class` text COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `option_1` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `option_2` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `option_3` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `option_4` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `option_5` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `option_6` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `option_7` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `option_8` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `option_9` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `answer` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=849 ;

-- --------------------------------------------------------

--
-- 表的结构 `saq`
--

CREATE TABLE IF NOT EXISTS `saq` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `class` text COLLATE utf8_unicode_ci NOT NULL,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `answer` varchar(480) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- 表的结构 `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `cate` text COLLATE utf8_unicode_ci NOT NULL COMMENT '科目',
  `class` text COLLATE utf8_unicode_ci NOT NULL COMMENT '班级',
  `startTime` datetime NOT NULL COMMENT '分钟',
  `overTime` datetime NOT NULL,
  `radio` text COLLATE utf8_unicode_ci NOT NULL,
  `checkbox` text COLLATE utf8_unicode_ci NOT NULL,
  `judge` text COLLATE utf8_unicode_ci NOT NULL,
  `fill` text COLLATE utf8_unicode_ci NOT NULL,
  `saq` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- 表的结构 `testtemp`
--

CREATE TABLE IF NOT EXISTS `testtemp` (
  `id` int(244) NOT NULL AUTO_INCREMENT,
  `userid` bigint(244) NOT NULL COMMENT '学生id',
  `class` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '考试科目',
  `testclass` text COLLATE utf32_unicode_ci NOT NULL COMMENT '题目类型',
  `classid` int(244) NOT NULL COMMENT '考试题目号',
  `anwers` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '学生答案',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=193 ;

-- --------------------------------------------------------

--
-- 表的结构 `test_manage`
--

CREATE TABLE IF NOT EXISTS `test_manage` (
  `id` int(240) NOT NULL AUTO_INCREMENT,
  `userid` bigint(240) NOT NULL,
  `name` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `curriculum` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `radio` text COLLATE utf8_unicode_ci NOT NULL,
  `checkbox` text COLLATE utf8_unicode_ci NOT NULL,
  `judge` text COLLATE utf8_unicode_ci NOT NULL,
  `fill` text COLLATE utf8_unicode_ci NOT NULL,
  `saq` text COLLATE utf8_unicode_ci NOT NULL,
  `objectivescore` int(2) NOT NULL,
  `subjectivescore` int(2) NOT NULL,
  `totalscore` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `test_pape`
--

CREATE TABLE IF NOT EXISTS `test_pape` (
  `id` int(240) NOT NULL AUTO_INCREMENT,
  `userid` bigint(240) NOT NULL,
  `name` varchar(48) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `curriculum` varchar(48) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `radio` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `checkbox` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `judge` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fill` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `saq` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `state` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(24) NOT NULL,
  `name` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `sex` int(1) NOT NULL,
  `password` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `vip` int(1) NOT NULL,
  `date` datetime NOT NULL,
  `login_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
