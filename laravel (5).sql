-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 01, 2026 lúc 06:33 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, '7db116d0-7dab-4127-a0e1-3760124aca7f', 'database', 'default', '{\"uuid\":\"7db116d0-7dab-4127-a0e1-3760124aca7f\",\"displayName\":\"App\\\\Mail\\\\PurchaseMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:21:\\\"App\\\\Mail\\\\PurchaseMail\\\":4:{s:4:\\\"plan\\\";s:6:\\\"yearly\\\";s:11:\\\"billingEnds\\\";s:10:\\\"2024-11-12\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";s:18:\\\"Phạm Quang Lộc\\\";s:7:\\\"address\\\";s:19:\\\"locmaymo@gmail.comq\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 'ErrorException: Undefined variable $price in D:\\Learning\\DaiHoc\\totnghiep\\untitled\\storage\\framework\\views\\4563b14f22ba9fe2052c4efd1ac0c643.php:16\nStack trace:\n#0 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Bootstrap\\HandleExceptions.php(254): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'Undefined varia...\', \'D:\\\\Learning\\\\Dai...\', 16)\n#1 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\storage\\framework\\views\\4563b14f22ba9fe2052c4efd1ac0c643.php(16): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}(2, \'Undefined varia...\', \'D:\\\\Learning\\\\Dai...\', 16)\n#2 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Filesystem\\Filesystem.php(124): require(\'D:\\\\Learning\\\\Dai...\')\n#3 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Filesystem\\Filesystem.php(125): Illuminate\\Filesystem\\Filesystem::Illuminate\\Filesystem\\{closure}()\n#4 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\PhpEngine.php(58): Illuminate\\Filesystem\\Filesystem->getRequire(\'D:\\\\Learning\\\\Dai...\', Array)\n#5 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\CompilerEngine.php(72): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'D:\\\\Learning\\\\Dai...\', Array)\n#6 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(195): Illuminate\\View\\Engines\\CompilerEngine->get(\'D:\\\\Learning\\\\Dai...\', Array)\n#7 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(178): Illuminate\\View\\View->getContents()\n#8 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(147): Illuminate\\View\\View->renderContents()\n#9 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Markdown.php(65): Illuminate\\View\\View->render()\n#10 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(366): Illuminate\\Mail\\Markdown->render(\'emails.notify\', Array)\n#11 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Collections\\helpers.php(224): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}(Array)\n#12 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(429): value(Object(Closure), Array)\n#13 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(408): Illuminate\\Mail\\Mailer->renderView(Object(Closure), Array)\n#14 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(320): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), Object(Closure), Object(Closure), NULL, Array)\n#15 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(205): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#16 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#17 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(198): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#18 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(83): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#19 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#20 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#21 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#22 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#23 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#24 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#25 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#26 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#27 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#28 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#29 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#30 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#31 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#32 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#33 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#34 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#35 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(389): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#36 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(176): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#37 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(137): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#38 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#39 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#40 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#41 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#42 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#43 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#44 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#45 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\symfony\\console\\Command\\Command.php(326): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#46 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#47 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\symfony\\console\\Application.php(1081): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\symfony\\console\\Application.php(320): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#49 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\symfony\\console\\Application.php(174): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#50 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(201): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#51 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#52 {main}\n\nNext Illuminate\\View\\ViewException: Undefined variable $price (View: D:\\Learning\\DaiHoc\\totnghiep\\untitled\\resources\\views\\emails\\notify.blade.php) in D:\\Learning\\DaiHoc\\totnghiep\\untitled\\storage\\framework\\views\\4563b14f22ba9fe2052c4efd1ac0c643.php:16\nStack trace:\n#0 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\PhpEngine.php(60): Illuminate\\View\\Engines\\CompilerEngine->handleViewException(Object(ErrorException), 0)\n#1 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\CompilerEngine.php(72): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'D:\\\\Learning\\\\Dai...\', Array)\n#2 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(195): Illuminate\\View\\Engines\\CompilerEngine->get(\'D:\\\\Learning\\\\Dai...\', Array)\n#3 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(178): Illuminate\\View\\View->getContents()\n#4 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(147): Illuminate\\View\\View->renderContents()\n#5 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Markdown.php(65): Illuminate\\View\\View->render()\n#6 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(366): Illuminate\\Mail\\Markdown->render(\'emails.notify\', Array)\n#7 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Collections\\helpers.php(224): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}(Array)\n#8 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(429): value(Object(Closure), Array)\n#9 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(408): Illuminate\\Mail\\Mailer->renderView(Object(Closure), Array)\n#10 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(320): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), Object(Closure), Object(Closure), NULL, Array)\n#11 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(205): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#12 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#13 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(198): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#14 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(83): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#15 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#16 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#17 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#18 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#19 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#20 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#21 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#22 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#23 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#25 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#26 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#27 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#28 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#29 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#30 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(389): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#32 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(176): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(137): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#34 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#35 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#37 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#38 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#39 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#40 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#41 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\symfony\\console\\Command\\Command.php(326): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#42 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#43 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\symfony\\console\\Application.php(1081): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\symfony\\console\\Application.php(320): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\symfony\\console\\Application.php(174): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(201): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 {main}', '2023-11-12 07:47:33'),
(2, '2aa73d6a-e0c1-4275-a971-52340cafd663', 'database', 'default', '{\"uuid\":\"2aa73d6a-e0c1-4275-a971-52340cafd663\",\"displayName\":\"App\\\\Mail\\\\PurchaseMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:21:\\\"App\\\\Mail\\\\PurchaseMail\\\":4:{s:4:\\\"plan\\\";s:6:\\\"yearly\\\";s:11:\\\"billingEnds\\\";s:10:\\\"2024-11-12\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";s:3:\\\"loc\\\";s:7:\\\"address\\\";s:15:\\\"pham@gmail.comq\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 'ErrorException: Undefined variable $price in D:\\Learning\\DaiHoc\\totnghiep\\untitled\\storage\\framework\\views\\4563b14f22ba9fe2052c4efd1ac0c643.php:16\nStack trace:\n#0 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Bootstrap\\HandleExceptions.php(254): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'Undefined varia...\', \'D:\\\\Learning\\\\Dai...\', 16)\n#1 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\storage\\framework\\views\\4563b14f22ba9fe2052c4efd1ac0c643.php(16): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}(2, \'Undefined varia...\', \'D:\\\\Learning\\\\Dai...\', 16)\n#2 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Filesystem\\Filesystem.php(124): require(\'D:\\\\Learning\\\\Dai...\')\n#3 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Filesystem\\Filesystem.php(125): Illuminate\\Filesystem\\Filesystem::Illuminate\\Filesystem\\{closure}()\n#4 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\PhpEngine.php(58): Illuminate\\Filesystem\\Filesystem->getRequire(\'D:\\\\Learning\\\\Dai...\', Array)\n#5 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\CompilerEngine.php(72): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'D:\\\\Learning\\\\Dai...\', Array)\n#6 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(195): Illuminate\\View\\Engines\\CompilerEngine->get(\'D:\\\\Learning\\\\Dai...\', Array)\n#7 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(178): Illuminate\\View\\View->getContents()\n#8 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(147): Illuminate\\View\\View->renderContents()\n#9 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Markdown.php(65): Illuminate\\View\\View->render()\n#10 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(366): Illuminate\\Mail\\Markdown->render(\'emails.notify\', Array)\n#11 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Collections\\helpers.php(224): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}(Array)\n#12 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(429): value(Object(Closure), Array)\n#13 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(408): Illuminate\\Mail\\Mailer->renderView(Object(Closure), Array)\n#14 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(320): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), Object(Closure), Object(Closure), NULL, Array)\n#15 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(205): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#16 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#17 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(198): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#18 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(83): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#19 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#20 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#21 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#22 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#23 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#24 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#25 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#26 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#27 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#28 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#29 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#30 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#31 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#32 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#33 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#34 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#35 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(389): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#36 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(176): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#37 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(137): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#38 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#39 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#40 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#41 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#42 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#43 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#44 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#45 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\symfony\\console\\Command\\Command.php(326): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#46 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#47 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\symfony\\console\\Application.php(1081): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\symfony\\console\\Application.php(320): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#49 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\symfony\\console\\Application.php(174): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#50 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(201): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#51 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#52 {main}\n\nNext Illuminate\\View\\ViewException: Undefined variable $price (View: D:\\Learning\\DaiHoc\\totnghiep\\untitled\\resources\\views\\emails\\notify.blade.php) in D:\\Learning\\DaiHoc\\totnghiep\\untitled\\storage\\framework\\views\\4563b14f22ba9fe2052c4efd1ac0c643.php:16\nStack trace:\n#0 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\PhpEngine.php(60): Illuminate\\View\\Engines\\CompilerEngine->handleViewException(Object(ErrorException), 0)\n#1 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\CompilerEngine.php(72): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'D:\\\\Learning\\\\Dai...\', Array)\n#2 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(195): Illuminate\\View\\Engines\\CompilerEngine->get(\'D:\\\\Learning\\\\Dai...\', Array)\n#3 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(178): Illuminate\\View\\View->getContents()\n#4 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(147): Illuminate\\View\\View->renderContents()\n#5 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Markdown.php(65): Illuminate\\View\\View->render()\n#6 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(366): Illuminate\\Mail\\Markdown->render(\'emails.notify\', Array)\n#7 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Collections\\helpers.php(224): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}(Array)\n#8 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(429): value(Object(Closure), Array)\n#9 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(408): Illuminate\\Mail\\Mailer->renderView(Object(Closure), Array)\n#10 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(320): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), Object(Closure), Object(Closure), NULL, Array)\n#11 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(205): Illuminate\\Mail\\Mailer->send(Object(Closure), Array, Object(Closure))\n#12 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#13 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(198): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#14 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(83): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#15 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#16 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#17 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#18 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#19 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#20 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#21 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#22 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#23 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#25 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#26 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#27 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#28 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#29 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#30 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(389): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#32 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(176): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(137): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#34 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#35 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#37 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#38 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#39 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#40 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#41 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\symfony\\console\\Command\\Command.php(326): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#42 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#43 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\symfony\\console\\Application.php(1081): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\symfony\\console\\Application.php(320): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\symfony\\console\\Application.php(174): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(201): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 D:\\Learning\\DaiHoc\\totnghiep\\untitled\\artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 {main}', '2023-11-12 07:47:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(32, 'default', '{\"uuid\":\"ba06a302-ae16-4378-aa46-16ad6800a0ca\",\"displayName\":\"App\\\\Mail\\\\ShortlistMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:22:\\\"App\\\\Mail\\\\ShortlistMail\\\":6:{s:12:\\\"company_name\\\";s:18:\\\"Phạm Quang Lộc\\\";s:13:\\\"company_email\\\";s:18:\\\"locmaymo@gmail.com\\\";s:4:\\\"name\\\";s:5:\\\"loc12\\\";s:5:\\\"title\\\";s:1:\\\"1\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:20:\\\"locmaymo12@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1700844992, 1700844992),
(33, 'default', '{\"uuid\":\"d53c5308-5dfa-41c8-a15c-e77f87efdf71\",\"displayName\":\"App\\\\Mail\\\\ShortlistMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:22:\\\"App\\\\Mail\\\\ShortlistMail\\\":6:{s:12:\\\"company_name\\\";s:18:\\\"Phạm Quang Lộc\\\";s:13:\\\"company_email\\\";s:18:\\\"locmaymo@gmail.com\\\";s:4:\\\"name\\\";s:20:\\\"zudkm8ar1h@laafd.com\\\";s:5:\\\"title\\\";s:1:\\\"1\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:20:\\\"zudkm8ar1h@laafd.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1700844993, 1700844993),
(34, 'default', '{\"uuid\":\"27ea60d3-5205-4cb8-9947-88fafa704930\",\"displayName\":\"App\\\\Mail\\\\ShortlistMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:22:\\\"App\\\\Mail\\\\ShortlistMail\\\":6:{s:12:\\\"company_name\\\";s:18:\\\"Phạm Quang Lộc\\\";s:13:\\\"company_email\\\";s:18:\\\"locmaymo@gmail.com\\\";s:4:\\\"name\\\";s:20:\\\"zudkm8ar1h@laafd.com\\\";s:5:\\\"title\\\";s:7:\\\"dsfgdsg\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:20:\\\"zudkm8ar1h@laafd.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1700855261, 1700855261),
(35, 'default', '{\"uuid\":\"79c07f9d-79ba-49c5-8469-1e3ae629f42a\",\"displayName\":\"App\\\\Mail\\\\ShortlistMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:22:\\\"App\\\\Mail\\\\ShortlistMail\\\":6:{s:12:\\\"company_name\\\";s:18:\\\"Phạm Quang Lộc\\\";s:13:\\\"company_email\\\";s:18:\\\"locmaymo@gmail.com\\\";s:4:\\\"name\\\";s:20:\\\"Nguyễn Văn Hiệp\\\";s:5:\\\"title\\\";s:7:\\\"dsfgdsg\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:20:\\\"trdbwd50u0@txcct.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1700855272, 1700855272),
(36, 'default', '{\"uuid\":\"a11ffa1f-9d33-4f0e-a360-dbeab61a005d\",\"displayName\":\"App\\\\Mail\\\\ShortlistMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:22:\\\"App\\\\Mail\\\\ShortlistMail\\\":6:{s:12:\\\"company_name\\\";s:18:\\\"Phạm Quang Lộc\\\";s:13:\\\"company_email\\\";s:18:\\\"locmaymo@gmail.com\\\";s:4:\\\"name\\\";s:18:\\\"Phạm Quang Lộc\\\";s:5:\\\"title\\\";s:7:\\\"dsfgdsg\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:20:\\\"0941lm84go@ezztt.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1700855274, 1700855274),
(37, 'default', '{\"uuid\":\"9abbcd08-ba43-4612-959c-fefb6dc0a3ad\",\"displayName\":\"App\\\\Mail\\\\ShortlistMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:22:\\\"App\\\\Mail\\\\ShortlistMail\\\":6:{s:12:\\\"company_name\\\";s:18:\\\"Phạm Quang Lộc\\\";s:13:\\\"company_email\\\";s:18:\\\"locmaymo@gmail.com\\\";s:4:\\\"name\\\";s:20:\\\"mtjf9drnqr@vjuum.com\\\";s:5:\\\"title\\\";s:7:\\\"dsfgdsg\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:20:\\\"mtjf9drnqr@vjuum.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1700855276, 1700855276),
(38, 'default', '{\"uuid\":\"61ba4128-040e-4e07-92a2-1ae3f94d5f2b\",\"displayName\":\"App\\\\Mail\\\\ShortlistMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:22:\\\"App\\\\Mail\\\\ShortlistMail\\\":6:{s:12:\\\"company_name\\\";s:18:\\\"Phạm Quang Lộc\\\";s:13:\\\"company_email\\\";s:18:\\\"locmaymo@gmail.com\\\";s:4:\\\"name\\\";s:20:\\\"zudkm8ar1h@laafd.com\\\";s:5:\\\"title\\\";s:8:\\\"ádfasdf\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:20:\\\"zudkm8ar1h@laafd.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1700855290, 1700855290);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `listings`
--

CREATE TABLE `listings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `predes` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `roles` text NOT NULL,
  `job_type` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `application_close_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `feature_image` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `salary` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `listings`
--

INSERT INTO `listings` (`id`, `user_id`, `title`, `predes`, `description`, `roles`, `job_type`, `address`, `application_close_date`, `created_at`, `updated_at`, `feature_image`, `slug`, `salary`) VALUES
(35, 98, 'chup anh dam cuoi DUC PHUC', 'chuyen chup anh cho cac cap doi sap cuoi anh gia ding', '<p>ca kien thuc ve may anh</p>', '<p>nhan vien ho tro&nbsp;</p>', 'Parttime', 'an dong', '2026-06-11', '2026-03-28 02:08:21', '2026-03-28 02:08:21', 'images/VmsOiva1OrcS0k25JoNlGsTpNZpFaHe1OmVWNpxP.jpg', 'chup-anh-dam-cuoi-duc-phuc.975f3e0c-b5db-448f-af5e-9e703594b69a', '3000'),
(36, 98, 'Frontend Developer', 'tuyen ho tro vien', '<p>thong thao</p>', '<p>\r\n<h3 data-section-id=\"1vku83q\" data-start=\"2207\" data-end=\"2220\"></h3></p><ul data-start=\"2158\" data-end=\"2205\"><li data-section-id=\"1j3sm39\" data-start=\"2158\" data-end=\"2164\">HTML,CSS,JavaScrip,tBootstrap,ReactJS</li>\r\n</ul>', 'Fulltime', 'an dong', '2026-03-31', '2026-03-29 07:13:14', '2026-03-29 07:13:14', 'images/CWjwCU8GkurXodh8xHci36kovMWv8tn1LFMYOfKr.jpg', 'frontend-developer.2419d292-bb76-4364-a395-47736726d908', '3000'),
(38, 98, 'congty moi mo', 'tuyen ho tro vien', '<p>HTML CSS JavaScript Bootstrap ReactUS</p>', '<p>HTML CSS JavaScript Bootstrap ReactUS</p>', 'Fulltime', 'an dong', '2026-12-23', '2026-03-29 07:57:15', '2026-03-29 07:57:15', 'images/v2kwo9mxLkax6O6H2fb6dKntR8JR6szLrGG1Q087.jpg', 'congty-moi-mo.d0d2fe5c-2006-4fde-9151-96887c1b61fd', '3000'),
(39, 98, 'the thao 24h', 'chuyen the thao', '<p>tat cho moi nha</p>', '<p>tat ca</p>', 'Fulltime', 'an dong', '2026-04-29', '2026-04-01 09:09:20', '2026-04-01 09:09:20', 'images/jBmt7ftsGo735B4LTjriq91VlCQjs1VvBryBiqdI.jpg', 'the-thao-24h.c1db38e9-b555-4e54-bd32-ae02c1834b75', '5000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `listing_skills`
--

CREATE TABLE `listing_skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `skill_id` bigint(20) UNSIGNED NOT NULL,
  `weight` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `listing_skills`
--

INSERT INTO `listing_skills` (`id`, `listing_id`, `skill_id`, `weight`, `created_at`, `updated_at`) VALUES
(6, 38, 1, 5, '2026-03-29 15:02:53', '2026-03-29 15:02:53'),
(7, 38, 2, 5, '2026-03-29 15:02:53', '2026-03-29 15:02:53'),
(8, 38, 3, 4, '2026-03-29 15:02:53', '2026-03-29 15:02:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `listing_user`
--

CREATE TABLE `listing_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shortlisted` tinyint(1) NOT NULL DEFAULT 0,
  `match_score` int(11) DEFAULT NULL,
  `match_level` varchar(50) DEFAULT NULL,
  `matched_skills` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `listing_user`
--

INSERT INTO `listing_user` (`id`, `listing_id`, `user_id`, `shortlisted`, `match_score`, `match_level`, `matched_skills`, `created_at`, `updated_at`) VALUES
(38, 38, 97, 1, 100, 'High', 'PHP, Laravel, MySQL', '2026-03-29 08:03:53', '2026-03-29 08:28:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_12_140750_create_jobs_table', 2),
(6, '2023_11_13_045013_create_listings_table', 3),
(7, '2023_11_13_054726_add_feature_image_to_listings', 4),
(8, '2023_11_13_071817_add_slug_to_listings_table', 5),
(9, '2023_11_16_145159_create_listing_user_table', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `skills`
--

INSERT INTO `skills` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'PHP', '2026-03-26 17:53:04', '2026-03-26 17:53:04'),
(2, 'Laravel', '2026-03-26 17:53:04', '2026-03-26 17:53:04'),
(3, 'MySQL', '2026-03-26 17:53:04', '2026-03-26 17:53:04'),
(4, 'HTML', '2026-03-26 17:53:04', '2026-03-26 17:53:04'),
(5, 'CSS', '2026-03-26 17:53:04', '2026-03-26 17:53:04'),
(6, 'JavaScript', '2026-03-26 17:53:04', '2026-03-26 17:53:04'),
(7, 'Bootstrap', '2026-03-26 17:53:04', '2026-03-26 17:53:04'),
(8, 'Python', '2026-03-26 17:53:04', '2026-03-26 17:53:04'),
(9, 'Java', '2026-03-26 17:53:04', '2026-03-26 17:53:04'),
(10, 'C#', '2026-03-26 17:53:04', '2026-03-26 17:53:04'),
(11, 'ReactJS', '2026-03-26 17:53:04', '2026-03-26 17:53:04'),
(12, 'NodeJS', '2026-03-26 17:53:04', '2026-03-26 17:53:04'),
(13, 'Git', '2026-03-26 17:53:04', '2026-03-26 17:53:04'),
(14, 'UI/UX', '2026-03-26 17:53:04', '2026-03-26 17:53:04'),
(15, 'Figma', '2026-03-26 17:53:04', '2026-03-26 17:53:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `about` text DEFAULT NULL,
  `mail` tinyint(4) NOT NULL DEFAULT 1,
  `profile_pic` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) NOT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `user_trial` date DEFAULT NULL,
  `billing_ends` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `plan` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `about`, `mail`, `profile_pic`, `user_type`, `resume`, `user_trial`, `billing_ends`, `status`, `plan`, `remember_token`, `created_at`, `updated_at`) VALUES
(96, 'APOLO', 'melodynight787898@gmail.com', NULL, '$2y$10$cgokUWs4BfFHaC27aav0SuubCayOKUC7cHnRbl8jhZqu4mI5Ssnqm', NULL, 1, NULL, 'employer', NULL, '2026-04-03', NULL, NULL, NULL, NULL, '2026-03-26 23:04:24', '2026-03-26 23:04:24'),
(97, 'phuc', 'melodynight2004@gmail.com', '2026-03-28 01:04:00', '$2y$10$mVmvGVW0pa.2MKpx6P.ujuTeudiu9ub24vN2Op/fT6QH7.FcUcXa.', NULL, 1, 'images/8tIyIJ5L9m8QITywJhNqjYghSfdvf2olUGsYxiYH.jpg', 'employee', 'resume/9yRbKvhI7FXsZ7oNbHBa9i3Fwdiap2M2BQU9b5SX.pdf', NULL, NULL, NULL, NULL, NULL, '2026-03-28 01:04:00', '2026-04-01 09:10:29'),
(98, 'gody', 'melodynight2003@gmail.com', '2026-03-28 02:02:35', '$2y$10$G8/In9mQj2KCCXjbwvE9kerzdDefhW5KvnNu4ESlU9FYxXSVMTfoW', NULL, 1, 'images/Jq0TtBTh5wzBkjX4xCirEDydq1KLPAQptj6UK8VP.jpg', 'employer', NULL, '2026-04-04', NULL, NULL, NULL, NULL, '2026-03-28 02:02:35', '2026-04-01 09:15:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_skills`
--

CREATE TABLE `user_skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `skill_id` bigint(20) UNSIGNED NOT NULL,
  `level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_skills`
--

INSERT INTO `user_skills` (`id`, `user_id`, `skill_id`, `level`, `created_at`, `updated_at`) VALUES
(5, 97, 1, 4, '2026-03-29 15:01:57', '2026-03-29 15:01:57'),
(6, 97, 2, 3, '2026-03-29 15:01:57', '2026-03-29 15:01:57'),
(7, 97, 3, 4, '2026-03-29 15:01:57', '2026-03-29 15:01:57');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `listing_skills`
--
ALTER TABLE `listing_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_listing_skills_listing` (`listing_id`),
  ADD KEY `fk_listing_skills_skill` (`skill_id`);

--
-- Chỉ mục cho bảng `listing_user`
--
ALTER TABLE `listing_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listing_user_listing_id_foreign` (`listing_id`),
  ADD KEY `listing_user_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `user_skills`
--
ALTER TABLE `user_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_skills_user` (`user_id`),
  ADD KEY `fk_user_skills_skill` (`skill_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `listings`
--
ALTER TABLE `listings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `listing_skills`
--
ALTER TABLE `listing_skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `listing_user`
--
ALTER TABLE `listing_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT cho bảng `user_skills`
--
ALTER TABLE `user_skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `listing_skills`
--
ALTER TABLE `listing_skills`
  ADD CONSTRAINT `fk_listing_skills_listing` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_listing_skills_skill` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `listing_user`
--
ALTER TABLE `listing_user`
  ADD CONSTRAINT `listing_user_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `listing_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user_skills`
--
ALTER TABLE `user_skills`
  ADD CONSTRAINT `fk_user_skills_skill` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_skills_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
