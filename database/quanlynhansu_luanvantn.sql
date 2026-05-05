-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql211.infinityfree.com
-- Generation Time: May 05, 2026 at 03:39 AM
-- Server version: 11.4.10-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_41118484_luanvantn`
--
CREATE DATABASE IF NOT EXISTS `if0_41118484_luanvantn` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `if0_41118484_luanvantn`;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `work_date` date NOT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `status` enum('present','late','absent') DEFAULT 'present',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `work_date`, `check_in`, `check_out`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-06-01', '08:00:00', '17:00:00', 'present', '2026-03-04 03:27:18', '2026-04-10 02:12:52'),
(2, 2, '2024-06-01', '08:15:00', '17:00:00', 'late', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(3, 3, '2024-06-01', '08:00:00', '17:00:00', 'present', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(4, 4, '2024-06-01', NULL, NULL, 'absent', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(5, 5, '2024-06-01', '08:00:00', '17:00:00', 'present', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(6, 6, '2024-06-01', '08:05:00', '17:00:00', 'late', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(7, 7, '2024-06-01', '08:00:00', '17:00:00', 'present', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(8, 8, '2024-06-01', '08:00:00', '17:00:00', 'present', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(9, 9, '2024-06-01', '08:10:00', '17:00:00', 'late', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(10, 10, '2024-06-01', '08:00:00', '17:00:00', 'present', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(11, 11, '2024-06-01', '08:00:00', '17:00:00', 'present', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(12, 12, '2024-06-01', '08:20:00', '17:00:00', 'late', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(13, 13, '2024-06-01', '08:00:00', '17:00:00', 'present', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(14, 14, '2024-06-01', NULL, NULL, 'absent', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(15, 15, '2024-06-01', '08:00:00', '17:00:00', 'present', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(16, 16, '2024-06-01', '08:00:00', '17:00:00', 'present', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(17, 17, '2024-06-01', '08:00:00', '17:00:00', 'present', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(18, 18, '2024-06-01', '08:00:00', '17:00:00', 'present', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(19, 19, '2024-06-01', '08:00:00', '17:00:00', 'present', '2026-03-04 03:27:18', '2026-03-04 03:27:18'),
(20, 20, '2024-06-01', '08:00:00', '17:00:00', 'present', '2026-03-04 03:27:18', '2026-03-04 03:27:18');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'HR', 'Human Resource', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(2, 'IT', 'Information Technology', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(3, 'Finance', 'Finance Department', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(4, 'Marketing', 'Marketing Department', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(5, 'Sales', 'Sales Department', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(6, 'Operations', 'Operations Department', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(7, 'Logistics', 'Logistics', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(8, 'Customer Service', 'Support', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(9, 'R&D', 'Research & Development', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(10, 'Legal', 'Legal Department', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(11, 'Admin', 'Administration', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(12, 'Security', 'Security', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(13, 'Production', 'Production', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(14, 'Quality Control', 'QC', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(15, 'Procurement', 'Procurement', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(16, 'Planning', 'Planning', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(17, 'Training', 'Training', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(18, 'Design', 'Design', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(19, 'Media', 'Media', '2026-03-04 03:26:10', '2026-03-04 03:26:10'),
(20, 'Strategy', 'Strategy', '2026-03-04 03:26:10', '2026-03-04 03:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `employee_code` varchar(50) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `status` enum('working','resigned') DEFAULT 'working',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `department_id`, `position_id`, `employee_code`, `full_name`, `gender`, `date_of_birth`, `phone`, `email`, `address`, `hire_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'EMP001', 'Nguyen Van A', 'male', '1995-05-10', '0901000001', 'emp1@gmail.com', '12 Nguyễn Trãi, Phường 5, Hà Nội', '2023-01-01', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(2, 2, 10, 'EMP002', 'Tran Thi B', 'female', '1998-08-15', '0901000002', 'emp2@gmail.com', '45 Lê Lợi, Phường 7, TP.HCM', '2023-02-01', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(3, 3, 8, 'EMP003', 'Le Van C', 'male', '1997-03-20', '0901000003', 'emp3@gmail.com', '78 Trần Hưng Đạo, Phường Hải Châu, Đà Nẵng', '2023-03-01', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(4, 4, 13, 'EMP004', 'Pham Thi D', 'female', '1996-11-12', '0901000004', 'emp4@gmail.com', '23 Nguyễn Văn Cừ, Phường An Khánh, Cần Thơ', '2023-04-01', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(5, 5, 14, 'EMP005', 'Hoang Van E', 'male', '1994-01-25', '0901000005', 'emp5@gmail.com', '56 Lạch Tray, Phường Lạch Tray, Hải Phòng', '2023-05-01', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(6, 6, 5, 'EMP006', 'Vo Thi F', 'female', '1993-07-18', '0901000006', 'emp6@gmail.com', '89 Đại lộ Bình Dương, Phường Phú Cường, Bình Dương', '2023-06-01', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(7, 7, 16, 'EMP007', 'Dang Van G', 'male', '1992-09-09', '0901000007', 'emp7@gmail.com', '34 Võ Thị Sáu, Phường Thống Nhất, Đồng Nai', '2023-07-01', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(8, 8, 5, 'EMP008', 'Bui Thi H', 'female', '1999-02-14', '0901000008', 'emp8@gmail.com', '67 Hùng Vương, Phường Phú Hội, Huế', '2023-08-01', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(9, 9, 4, 'EMP009', 'Do Van I', 'male', '2000-06-30', '0901000009', 'emp9@gmail.com', '90 Phan Châu Trinh, Phường Minh An, Quảng Nam', '2023-09-01', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(10, 10, 19, 'EMP010', 'Ngo Thi K', 'female', '1991-12-01', '0901000010', 'emp10@gmail.com', '15 Trần Phú, Phường Vĩnh Hải, Nha Trang', '2023-10-01', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(11, 11, 20, 'EMP011', 'Ly Van L', 'male', '1990-04-05', '0901000011', 'emp11@gmail.com', '28 Ba Cu, Phường 1, Vũng Tàu', '2023-01-15', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(12, 12, 15, 'EMP012', 'Tran Van M', 'male', '1996-06-06', '0901000012', 'emp12@gmail.com', '41 Quốc lộ 1A, Phường 2, Long An', '2023-02-15', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(13, 13, 17, 'EMP013', 'Nguyen Thi N', 'female', '1997-07-07', '0901000013', 'emp13@gmail.com', '52 Lý Thường Kiệt, Phường 1, Tiền Giang', '2023-03-15', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(14, 14, 18, 'EMP014', 'Pham Van O', 'male', '1998-08-08', '0901000014', 'emp14@gmail.com', '63 Nguyễn Huệ, Phường 3, Bến Tre', '2023-04-15', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(15, 15, 3, 'EMP015', 'Le Thi P', 'female', '1999-09-09', '0901000015', 'emp15@gmail.com', '74 Trần Phú, Phường Mỹ Bình, An Giang', '2023-05-15', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(16, 16, 6, 'EMP016', 'Hoang Van Q', 'male', '2000-10-10', '0901000016', 'emp16@gmail.com', '85 Nguyễn Trung Trực, Phường Vĩnh Thanh, Kiên Giang', '2023-06-15', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(17, 17, 7, 'EMP017', 'Dang Thi R', 'female', '1995-11-11', '0901000017', 'emp17@gmail.com', '96 Phan Ngọc Hiển, Phường 5, Cà Mau', '2023-07-15', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(18, 18, 12, 'EMP018', 'Bui Van S', 'male', '1994-12-12', '0901000018', 'emp18@gmail.com', '11 Lê Hồng Phong, Phường 6, Sóc Trăng', '2023-08-15', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(19, 19, 9, 'EMP019', 'Do Thi T', 'female', '1993-03-03', '0901000019', 'emp19@gmail.com', '22 Trần Huỳnh, Phường 7, Bạc Liêu', '2023-09-15', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(20, 20, 11, 'EMP020', 'Ngo Van U', 'male', '1992-02-02', '0901000020', 'emp20@gmail.com', '33 Phan Đình Phùng, Phường Quyết Thắng, Kon Tum', '2023-10-15', 'working', '2026-03-04 03:26:41', '2026-04-14 11:01:39'),
(21, 1, 1, 'EMP021', 'Nguyen Van D', 'male', '1991-01-01', '0901000021', 'emp21@gmail.com', '44 Hùng Vương, Phường Hoa Lư, Gia Lai', '2023-11-15', 'working', '2026-04-08 13:49:36', '2026-04-14 11:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `employee_id`, `start_date`, `end_date`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-06-10', '2024-06-12', 'Personal', 'approved', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(2, 2, '2024-06-15', '2024-06-16', 'Sick', 'pending', '2026-03-04 03:27:32', '2026-04-10 02:26:34'),
(3, 3, '2024-06-20', '2024-06-22', 'Family', 'rejected', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(4, 4, '2024-06-25', '2024-06-26', 'Travel', 'approved', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(5, 5, '2024-06-27', '2024-06-28', 'Personal', 'pending', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(6, 6, '2024-07-01', '2024-07-02', 'Sick', 'approved', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(7, 7, '2024-07-03', '2024-07-04', 'Family', 'approved', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(8, 8, '2024-07-05', '2024-07-06', 'Travel', 'pending', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(9, 9, '2024-07-07', '2024-07-08', 'Personal', 'approved', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(10, 10, '2024-07-09', '2024-07-10', 'Sick', 'approved', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(11, 11, '2024-07-11', '2024-07-12', 'Family', 'pending', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(12, 12, '2024-07-13', '2024-07-14', 'Travel', 'approved', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(13, 13, '2024-07-15', '2024-07-16', 'Personal', 'approved', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(14, 14, '2024-07-17', '2024-07-18', 'Sick', 'rejected', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(15, 15, '2024-07-19', '2024-07-20', 'Family', 'approved', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(16, 16, '2024-07-21', '2024-07-22', 'Travel', 'approved', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(17, 17, '2024-07-23', '2024-07-24', 'Personal', 'pending', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(18, 18, '2024-07-25', '2024-07-26', 'Sick', 'approved', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(19, 19, '2024-07-27', '2024-07-28', 'Family', 'approved', '2026-03-04 03:27:32', '2026-03-04 03:27:32'),
(20, 20, '2024-07-29', '2024-07-30', 'Travel', 'approved', '2026-03-04 03:27:32', '2026-03-04 03:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `base_salary` int(11) NOT NULL,
  `bonus` int(11) DEFAULT 0,
  `deduction` int(11) DEFAULT 0,
  `total_salary` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payrolls`
--

INSERT INTO `payrolls` (`id`, `employee_id`, `month`, `year`, `base_salary`, `bonus`, `deduction`, `total_salary`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 2026, 20000000, 2000000, 500000, 21500000, '2026-03-04 03:27:46', '2026-04-04 03:41:55'),
(2, 2, 4, 2026, 15000000, 1000000, 300000, 15700000, '2026-03-04 03:27:46', '2026-04-04 03:42:01'),
(3, 3, 4, 2026, 11000000, 500000, 200000, 11300000, '2026-03-04 03:27:46', '2026-04-04 03:42:06'),
(4, 4, 4, 2026, 9500000, 300000, 100000, 9700000, '2026-03-04 03:27:46', '2026-04-04 03:42:11'),
(5, 5, 4, 2026, 9000000, 200000, 100000, 9100000, '2026-03-04 03:27:46', '2026-04-04 03:42:18'),
(6, 6, 4, 2026, 10000000, 500000, 200000, 10300000, '2026-03-04 03:27:46', '2026-04-04 03:42:22'),
(7, 7, 4, 2026, 8500000, 300000, 100000, 8700000, '2026-03-04 03:27:46', '2026-04-04 03:42:27'),
(8, 8, 4, 2026, 10000000, 500000, 200000, 10300000, '2026-03-04 03:27:46', '2026-04-04 03:42:32'),
(9, 9, 4, 2026, 12000000, 600000, 300000, 12300000, '2026-03-04 03:27:46', '2026-04-04 03:42:41'),
(10, 10, 4, 2026, 18000000, 1000000, 500000, 18500000, '2026-03-04 03:27:46', '2026-04-04 03:42:46'),
(11, 11, 4, 2026, 8500000, 200000, 100000, 8600000, '2026-03-04 03:27:46', '2026-04-04 03:42:51'),
(12, 12, 4, 2026, 7000000, 200000, 100000, 7100000, '2026-03-04 03:27:46', '2026-04-04 03:42:55'),
(13, 13, 4, 2026, 7500000, 300000, 100000, 7700000, '2026-03-04 03:27:46', '2026-04-04 03:43:00'),
(14, 14, 4, 2026, 14000000, 800000, 200000, 14600000, '2026-03-04 03:27:46', '2026-04-04 03:43:04'),
(15, 15, 4, 2026, 15000000, 1000000, 500000, 15500000, '2026-03-04 03:27:46', '2026-04-04 03:43:09'),
(16, 16, 4, 2026, 8000000, 200000, 100000, 8100000, '2026-03-04 03:27:46', '2026-04-04 03:43:13'),
(17, 17, 4, 2026, 4000000, 100000, 0, 4100000, '2026-03-04 03:27:46', '2026-04-04 03:43:18'),
(18, 18, 4, 2026, 13000000, 500000, 200000, 13300000, '2026-03-04 03:27:46', '2026-04-04 03:43:22'),
(19, 19, 4, 2026, 9000000, 300000, 100000, 9200000, '2026-03-04 03:27:46', '2026-04-04 03:43:26'),
(20, 20, 4, 2026, 12000000, 600000, 200000, 12400000, '2026-03-04 03:27:46', '2026-04-04 03:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `base_salary` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `base_salary`, `created_at`, `updated_at`) VALUES
(1, 'Director', 30000000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(2, 'Manager', 20000000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(3, 'Team Leader', 15000000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(4, 'Senior Staff', 12000000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(5, 'Staff', 10000000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(6, 'Junior Staff', 8000000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(7, 'Intern', 4000000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(8, 'Accountant', 11000000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(9, 'HR Executive', 9000000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(10, 'Developer', 15000000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(11, 'Tester', 12000000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(12, 'Designer', 13000000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(13, 'Marketing Executive', 9500000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(14, 'Sales Executive', 9000000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(15, 'Security Officer', 7000000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(16, 'Technician', 8500000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(17, 'Operator', 7500000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(18, 'Supervisor', 14000000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(19, 'Consultant', 18000000, '2026-03-04 03:26:21', '2026-03-04 03:26:21'),
(20, 'Assistant', 8500000, '2026-03-04 03:26:21', '2026-03-04 03:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2026-03-04 03:25:14', '2026-03-04 03:25:14'),
(2, 'user', '2026-03-04 03:25:25', '2026-03-04 03:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(21, 2, 'HR Staff 01', 'hr01@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:38:07'),
(22, 2, 'HR Staff 02', 'hr02@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:38:04'),
(23, 2, 'HR Staff 03', 'hr03@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:38:00'),
(24, 2, 'HR Staff 04', 'hr04@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:37:54'),
(25, 2, 'HR Staff 05', 'hr05@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:37:48'),
(26, 2, 'HR Staff 06', 'hr06@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:37:44'),
(27, 2, 'HR Staff 07', 'hr07@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:37:39'),
(28, 2, 'HR Staff 08', 'hr08@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:37:36'),
(29, 2, 'HR Staff 09', 'hr09@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:37:30'),
(30, 2, 'HR Staff 10', 'hr10@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:37:23'),
(31, 2, 'HR Staff 11', 'hr11@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:37:16'),
(32, 2, 'HR Staff 12', 'hr12@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:37:12'),
(33, 2, 'HR Staff 13', 'hr13@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:37:04'),
(34, 2, 'HR Staff 14', 'hr14@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:36:59'),
(35, 2, 'HR Staff 15', 'hr15@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:36:50'),
(36, 2, 'HR Staff 16', 'hr16@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:36:47'),
(37, 2, 'HR Staff 17', 'hr17@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:36:43'),
(38, 2, 'HR Staff 18', 'hr18@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:36:40'),
(39, 2, 'HR Staff 19', 'hr19@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:36:36'),
(40, 2, 'HR Staff 20', 'hr20@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 03:25:48', '2026-05-05 07:36:33'),
(41, 1, 'Admin HR', 'admin@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', '2026-03-04 11:38:22', '2026-05-05 14:35:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`,`work_date`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_code` (`employee_code`),
  ADD KEY `fk_employee_department` (`department_id`),
  ADD KEY `fk_employee_position` (`position_id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_leave_employee` (`employee_id`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`,`month`,`year`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_users_role` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `fk_attendance_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk_employee_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_employee_position` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `fk_leave_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD CONSTRAINT `fk_payroll_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
