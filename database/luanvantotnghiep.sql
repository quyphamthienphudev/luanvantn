-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th6 17, 2026 lúc 06:45 PM
-- Phiên bản máy phục vụ: 11.4.12-MariaDB
-- Phiên bản PHP: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `luanvantotnghiep`
--
CREATE DATABASE IF NOT EXISTS `luanvantotnghiep` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `luanvantotnghiep`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attendances`
--

DROP TABLE IF EXISTS `attendances`;
CREATE TABLE IF NOT EXISTS `attendances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `work_date` date NOT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `status` enum('present','late','absent') NOT NULL DEFAULT 'absent',
  `confirm` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_id` (`users_id`,`work_date`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `attendances`
--

INSERT INTO `attendances` (`id`, `users_id`, `work_date`, `check_in`, `check_out`, `status`, `confirm`) VALUES
(1, 21, '2026-06-01', '08:00:00', '17:00:00', 'present', 'yes'),
(2, 22, '2026-06-01', '08:15:00', '17:00:00', 'late', 'no'),
(3, 23, '2026-06-01', '08:00:00', '17:00:00', 'present', 'yes'),
(4, 24, '2026-06-01', NULL, NULL, 'absent', 'no'),
(5, 25, '2026-06-01', '08:00:00', '17:00:00', 'present', 'yes'),
(6, 26, '2026-06-01', '08:05:00', '17:00:00', 'late', 'no'),
(7, 27, '2026-06-01', '08:00:00', '17:00:00', 'present', 'yes'),
(8, 28, '2026-06-01', '08:00:00', '17:00:00', 'present', 'yes'),
(9, 29, '2026-06-01', '08:10:00', '17:00:00', 'late', 'no'),
(10, 30, '2026-06-01', '08:00:00', '17:00:00', 'present', 'yes'),
(11, 31, '2026-06-01', '08:00:00', '17:00:00', 'present', 'yes'),
(12, 32, '2026-06-01', '08:20:00', '17:00:00', 'late', 'no'),
(13, 33, '2026-06-01', '08:00:00', '17:00:00', 'present', 'yes'),
(14, 34, '2026-06-01', NULL, NULL, 'absent', 'no'),
(15, 35, '2026-06-01', '08:00:00', '17:00:00', 'present', 'yes'),
(16, 36, '2026-06-01', '08:00:00', '17:00:00', 'present', 'yes'),
(17, 37, '2026-06-01', '08:00:00', '17:00:00', 'present', 'yes'),
(18, 38, '2026-06-01', '08:00:00', '17:00:00', 'present', 'yes'),
(19, 39, '2026-06-01', '08:00:00', '17:00:00', 'present', 'yes'),
(20, 40, '2026-06-01', '08:00:00', '17:00:00', 'present', 'yes'),
(26, 33, '2026-06-11', '08:27:53', '08:27:54', 'late', 'no');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `candidates`
--

DROP TABLE IF EXISTS `candidates`;
CREATE TABLE IF NOT EXISTS `candidates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` varchar(20) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `education` text NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `street` text DEFAULT NULL,
  `ward` text DEFAULT NULL,
  `province` text DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `candidate_id` (`candidate_id`),
  KEY `fk_user_candidate` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `candidates`
--

INSERT INTO `candidates` (`id`, `candidate_id`, `full_name`, `first_name`, `last_name`, `gender`, `date_of_birth`, `phone`, `education`, `email`, `address`, `street`, `ward`, `province`, `users_id`) VALUES
(24, 'CAD001', 'Nguyễn Văn Anh', 'Anh', 'Nguyễn Văn', 'male', '1998-03-15', '0901234567', 'Bachelor of Information Technology', 'anh.nguyen@gmail.com', '123', 'Nguyễn Trãi', 'phường Bến Thành', 'Thành phố Hồ Chí Minh', 21),
(25, 'CAD002', 'Trần Thị Bích', 'Bích', 'Trần Thị', 'female', '1997-07-22', '0901234568', 'Bachelor of Business Administration', 'bich.tran@gmail.com', '45', 'Lê Lợi', 'phường Bến Nghé', 'Thành phố Hồ Chí Minh', 21),
(26, 'CAD003', 'Lê Minh Khoa', 'Khoa', 'Lê Minh', 'male', '1995-11-10', '0901234569', 'Bachelor of Computer Science', 'khoa.le@gmail.com', '78', 'Hai Bà Trưng', 'phường Đa Kao', 'Thành phố Hồ Chí Minh', 21),
(27, 'CAD004', 'Phạm Ngọc Mai', 'Mai', 'Phạm Ngọc', 'female', '1999-02-18', '0901234570', 'Bachelor of Marketing', 'mai.pham@gmail.com', '89', 'Võ Văn Tần', 'phường Thống Nhất', 'Thành phố Hồ Chí Minh', 21),
(28, 'CAD005', 'Hoàng Gia Bảo', 'Bảo', 'Hoàng Gia', 'male', '1994-06-05', '0901234571', 'Bachelor of Finance', 'bao.hoang@gmail.com', '15', 'Điện Biên Phủ', 'phường An Hội Đông', 'Thành phố Hồ Chí Minh', 21),
(29, 'CAD006', 'Võ Thị Lan', 'Lan', 'Võ Thị', 'female', '2000-09-12', '0901234572', 'Bachelor of Human Resource Management', 'lan.vo@gmail.com', '67', 'Phan Xích Long', 'phường Bàn Cờ', 'Thành phố Hồ Chí Minh', 21),
(30, 'CAD007', 'Đặng Quốc Hùng', 'Hùng', 'Đặng Quốc', 'male', '1996-12-08', '0901234573', 'Bachelor of Accounting', 'hung.dang@gmail.com', '112', 'Cách Mạng Tháng 8', 'phường Phú Thọ', 'Thành phố Hồ Chí Minh', 21),
(31, 'CAD008', 'Bùi Thanh Hà', 'Hà', 'Bùi Thanh', 'female', '1993-05-25', '0901234574', 'Master of Economics', 'ha.bui@gmail.com', '39', 'Nguyễn Đình Chiểu', 'phường Đa Kao', 'Thành phố Hồ Chí Minh', 21),
(32, 'CAD009', 'Nguyễn Đức Long', 'Long', 'Nguyễn Đức', 'male', '1992-08-19', '0901234575', 'Bachelor of Software Engineering', 'long.nguyen@gmail.com', '200', 'Trường Chinh', 'phường Tân Hưng Thuận', 'Thành phố Hồ Chí Minh', 21),
(33, 'CAD010', 'Trần Thu Trang', 'Trang', 'Trần Thu', 'female', '1998-01-30', '0901234576', 'Bachelor of International Business', 'trang.tran@gmail.com', '56', 'Cộng Hoà', 'phường Phú Lâm', 'Thành phố Hồ Chí Minh', 21),
(34, 'CAD011', 'Lê Hoàng Nam', 'Nam', 'Lê Hoàng', 'male', '1991-04-14', '0901234577', 'Bachelor of Mechanical Engineering', 'nam.le@gmail.com', '22', 'Quang Trung', 'phường Bình Thới', 'Thành phố Hồ Chí Minh', 21),
(35, 'CAD012', 'Phạm Thị Yến', 'Yến', 'Phạm Thị', 'female', '1997-10-03', '0901234578', 'Bachelor of English Language', 'yen.pham@gmail.com', '88', 'Nguyễn Văn Cừ', 'phường Bình Tiên', 'Thành phố Hồ Chí Minh', 21),
(36, 'CAD013', 'Đỗ Văn Tuấn', 'Tuấn', 'Đỗ Văn', 'male', '2001-07-27', '0901234579', 'Bachelor of Data Science', 'tuan.do@gmail.com', '175', 'Kha Văn Cần', 'phường Linh Tây', 'Thành phố Hồ Chí Minh', 21),
(37, 'CAD014', 'Nguyễn Thị Hương', 'Hương', 'Nguyễn Thị', 'female', '1995-09-09', '0901234580', 'Bachelor of Banking and Finance', 'huong.nguyen@gmail.com', '62', 'Phạm Văn Đồng', 'phường Linh Đông', 'Thành phố Hồ Chí Minh', 21),
(38, 'CAD015', 'Vũ Quang Huy', 'Huy', 'Vũ Quang', 'male', '1990-12-21', '0901234581', 'Master of Information Systems', 'huy.vu@gmail.com', '101', 'Hoàng Hoa Thám', 'phường Tân Sơn Nhì', 'Thành phố Hồ Chí Minh', 21),
(39, 'CAD016', 'Phạm Ngọc Anh', 'Anh', 'Phạm Ngọc', 'female', '2002-03-17', '0901234582', 'Bachelor of Graphic Design', 'anh.pham@gmail.com', '31', 'Nguyễn Hữu Cảnh', 'phường Thạnh Mỹ Tây', 'Thành phố Hồ Chí Minh', 21),
(40, 'CAD017', 'Trần Minh Đức', 'Đức', 'Trần Minh', 'male', '1996-06-28', '0901234583', 'Bachelor of Cyber Security', 'duc.tran@gmail.com', '76', 'Âu Cơ', 'phường Nhiêu Lộc', 'Thành phố Hồ Chí Minh', 21),
(41, 'CAD018', 'Lê Thị Ngân', 'Ngân', 'Lê Thị', 'female', '2000-11-05', '0901234584', 'Bachelor of Public Relations', 'ngan.le@gmail.com', '55', 'Lạc Long Quân', 'phường Bình Đông', 'Thành phố Hồ Chí Minh', 21),
(42, 'CAD019', 'Nguyễn Thanh Sơn', 'Sơn', 'Nguyễn Thanh', 'male', '1994-02-11', '0901234585', 'Bachelor of Logistics and Supply Chain Management', 'son.nguyen@gmail.com', '120', 'Phạm Hùng', 'phường Tân Phong', 'Thành phố Hồ Chí Minh', 21),
(43, 'CAD020', 'Đỗ Thị Thảo', 'Thảo', 'Đỗ Thị', 'female', '2005-01-15', '0901234586', 'Bachelor of Hospitality Management', 'thao.do@gmail.com', '98', 'Nguyễn Thị Minh Khai', 'phường Chợ Quán', 'Thành phố Hồ Chí Minh', 21);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contracts`
--

DROP TABLE IF EXISTS `contracts`;
CREATE TABLE IF NOT EXISTS `contracts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `contract_code` varchar(50) NOT NULL,
  `contract_type` enum('probation','fixed_term','indefinite') NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `salary` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `contract_file` varchar(255) DEFAULT NULL,
  `status` enum('active','expired','terminated') DEFAULT 'active',
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contract_code` (`contract_code`),
  KEY `fk_contract_employee` (`employee_id`),
  KEY `fk_contract_user` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contracts`
--

INSERT INTO `contracts` (`id`, `employee_id`, `contract_code`, `contract_type`, `start_date`, `end_date`, `salary`, `description`, `contract_file`, `status`, `users_id`) VALUES
(56, 1, 'HD1781696041', 'probation', '2026-06-01', '2026-06-06', 1000000, 'Hợp đồng thử việc 1 tuần', 'contracts/GIFzeOMAHnTQwLQzlXgqnEjH1dSDzMEdBdAmxq98.pdf', 'expired', 21),
(57, 1, 'HD1781696059', 'fixed_term', '2026-06-17', '2027-06-17', 1000000, 'Hợp đồng thử việc 1 tuần', 'contracts/GIFzeOMAHnTQwLQzlXgqnEjH1dSDzMEdBdAmxq98.pdf', 'expired', 21),
(58, 2, 'HD1781696170', 'indefinite', '2026-07-01', NULL, 20000000, 'Hợp đồng không xác định thời hạn từ tháng 07 năm 2026', 'contracts/n3PFXJPP3i3SgxV3AzVaMAmOGgxh9wrMq4nWdgIO.pdf', 'terminated', 21),
(59, 1, 'HD1781696309', 'fixed_term', '2026-06-17', '2027-06-17', 1000000, 'Hợp đồng thử việc 1 tuần', 'contracts/GIFzeOMAHnTQwLQzlXgqnEjH1dSDzMEdBdAmxq98.pdf', 'active', 21);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `fk_user_department` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `users_id`) VALUES
(1, 'HR', 'Phòng hành chính nhân sự', 21),
(2, 'IT', 'Phòng hệ thống thông tin', 21),
(3, 'Finance', 'Phòng tài chính kế toán', 21),
(4, 'Marketing', 'Phòng marketing', 21),
(5, 'Sales', 'Phòng sales', 21),
(14, 'Quality Control', 'Phòng quản lý chất lượng', 21),
(19, 'Media', 'Phòng truyền thông', 21),
(24, 'Tester', 'Phòng kiểm thử phần mềm', 21),
(25, 'Dev', 'Phòng lập trình phần mềm', 21);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `employee_code` varchar(50) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `street` text DEFAULT NULL,
  `ward` text DEFAULT NULL,
  `province` text DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `status` enum('working','resigned') NOT NULL DEFAULT 'working',
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_code` (`employee_code`),
  KEY `fk_employee_department` (`department_id`),
  KEY `fk_employee_position` (`position_id`),
  KEY `fk_user_employee` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `employees`
--

INSERT INTO `employees` (`id`, `department_id`, `position_id`, `employee_code`, `full_name`, `gender`, `date_of_birth`, `phone`, `email`, `address`, `street`, `ward`, `province`, `hire_date`, `status`, `users_id`) VALUES
(1, 25, 4, 'EMP001', 'Trần Thị Mười', 'female', '1995-05-10', '0901000001', 'emp01@gmail.com', '12', 'Nguyễn Trãi', 'phường An Phú Đông', 'Thành phố Hồ Chí Minh', '2023-01-01', 'working', 45),
(2, 2, 1, 'EMP002', 'Ngô Văn Uyên', 'female', '1998-08-15', '0901000002', 'emp02@gmail.com', '45', 'Lê Lợi', 'phường Tân Sơn Nhất', 'Thành phố Hồ Chí Minh', '2023-02-01', 'working', 22),
(3, 24, 2, 'EMP003', 'Đỗ Thị Thảo', 'female', '1997-03-20', '0901000003', 'emp03@gmail.com', '78', 'Trần Hưng Đạo', 'phường Hải Châu', 'Thành phố Hồ Chí Minh', '2023-03-01', 'working', 23),
(4, 25, 3, 'EMP004', 'Bùi Văn Sang', 'male', '1996-11-12', '0901000004', 'emp04@gmail.com', '23', 'Nguyễn Văn Cừ', 'phường An Khánh', 'Thành phố Hồ Chí Minh', '2023-04-01', 'working', 24),
(5, 25, 4, 'EMP005', 'Đặng Thị Hoa', 'female', '1994-01-25', '0901000005', 'emp05@gmail.com', '56', 'Lạch Tray', 'phường Lạch Tray', 'Thành phố Hồ Chí Minh', '2023-05-01', 'working', 25),
(6, 25, 6, 'EMP006', 'Hoàng Văn Quyết', 'male', '1993-07-18', '0901000006', 'emp06@gmail.com', '89', 'Đại Lộ Bình Dường', 'phường Phú Cường', 'Thành phố Hồ Chí Minh', '2023-06-01', 'working', 26),
(7, 1, 9, 'EMP007', 'Lê Thị Phương', 'female', '1992-09-09', '0901000007', 'emp07@gmail.com', '34', 'Võ Thị Sáu', 'phường Thống Nhất', 'Thành phố Hồ Chí Minh', '2023-07-01', 'working', 27),
(8, 25, 10, 'EMP008', 'Phạm Văn Oanh', 'female', '1999-02-14', '0901000008', 'emp08@gmail.com', '67', 'Hùng Vương', 'phường Phú Hội', 'Thành phố Hồ Chí Minh', '2023-08-01', 'working', 28),
(9, 24, 11, 'EMP009', 'Nguyễn Thị Tuyết Nga', 'female', '2000-06-30', '0901000009', 'emp09@gmail.com', '90', 'Phan Châu Trinh', 'phường Minh An', 'Thành phố Hồ Chí Minh', '2023-09-01', 'working', 29),
(10, 4, 13, 'EMP010', 'Trần Văn Mười', 'male', '1991-12-01', '0901000010', 'emp10@gmail.com', '15', 'Trần Phú', 'phường Vĩnh Hải', 'Thành phố Hồ Chí Minh', '2023-10-01', 'working', 30),
(11, 5, 14, 'EMP011', 'Nguyễn Minh Lợi', 'male', '1990-04-05', '0901000011', 'emp11@gmail.com', '28', 'Ba Cu', 'phường Tân Sơn Hoà', 'Thành phố Hồ Chí Minh', '2023-01-15', 'working', 31),
(12, 2, 1, 'EMP012', 'Ngô Thị Tuyết', 'female', '1996-06-06', '0901000012', 'emp12@gmail.com', '41', 'Quốc lộ 1A', 'phường Bàn Cờ', 'Thành phố Hồ Chí Minh', '2023-02-15', 'working', 32),
(13, 24, 2, 'EMP013', 'Đỗ Văn Long', 'male', '1997-07-07', '0901000013', 'emp13@gmail.com', '52', 'Lý Thường Kiệt', 'phường An Phú Đông', 'Thành phố Hồ Chí Minh', '2023-03-15', 'working', 33),
(14, 25, 3, 'EMP014', 'Bùi Thị Hoa', 'female', '1998-08-08', '0901000014', 'emp14@gmail.com', '63', 'Nguyễn Huệ', 'phường Vĩnh Hội', 'Thành phố Hồ Chí Minh', '2023-04-15', 'working', 34),
(15, 25, 4, 'EMP015', 'Đặng Văn Giáp', 'male', '1999-09-09', '0901000015', 'emp15@gmail.com', '74', 'Trần Phú', 'phường Mỹ Bình', 'Thành phố Hồ Chí Minh', '2023-05-15', 'working', 35),
(16, 25, 6, 'EMP016', 'Nguyễn Xuân Huỳnh', 'female', '2000-10-10', '0901000016', 'emp16@gmail.com', '85', 'Nguyễn Trung Trực', 'phường Vĩnh Thanh', 'Thành phố Hồ Chí Minh', '2023-06-15', 'working', 46),
(17, 1, 9, 'EMP017', 'Hoàng Văn Anh', 'male', '1995-11-11', '0901000017', 'emp17@gmail.com', '96', 'Phạm Ngọc Hiển', 'phường Bàn Cờ', 'Thành phố Hồ Chí Minh', '2023-07-15', 'working', 37),
(18, 5, 10, 'EMP018', 'Phạm Thị Dung', 'female', '1994-12-12', '0901000018', 'emp18@gmail.com', '11', 'Lê Hồng Phong', 'phường Bình Tây', 'Thành phố Hồ Chí Minh', '2023-08-15', 'working', 38),
(19, 24, 11, 'EMP019', 'Lê Văn Chính', 'male', '1993-03-03', '0901000019', 'emp19@gmail.com', '22', 'Trần Huỳnh', 'phường Tân Sơn Nhất', 'Thành phố Hồ Chí Minh', '2023-09-15', 'working', 39),
(20, 4, 13, 'EMP020', 'Trần Thị Tuyết', 'female', '1992-02-02', '0901000020', 'emp20@gmail.com', '33', 'Phan Đình Phùng', 'phường Quyết Thắng', 'Thành phố Hồ Chí Minh', '2023-10-15', 'working', 40),
(21, 5, 14, 'EMP021', 'Lê Phong', 'male', '1991-01-01', '0901000021', 'emp21@gmail.com', '44', 'Hùng Vương', 'phường Hoa Lư', 'Thành phố Hồ Chí Minh', '2023-11-15', 'resigned', 47);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employee_certificates`
--

DROP TABLE IF EXISTS `employee_certificates`;
CREATE TABLE IF NOT EXISTS `employee_certificates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `certificate_name` varchar(255) NOT NULL,
  `certificate_file` varchar(255) NOT NULL,
  `issue_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `employee_certificates`
--

INSERT INTO `employee_certificates` (`id`, `employee_id`, `certificate_name`, `certificate_file`, `issue_date`, `expiry_date`) VALUES
(4, 1, 'chứng chỉ tiếng anh', '1781694773_test chung chi.jpg', '2026-06-01', '2028-06-01'),
(5, 1, 'chứng chỉ tiếng nhật', '1781694805_test chung chi.pdf', '2026-06-17', '2027-06-17'),
(6, 2, 'chứng chỉ tiếng anh', '1781694845_test chung chi.pdf', '2026-06-30', '2028-06-30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `leave_requests`
--

DROP TABLE IF EXISTS `leave_requests`;
CREATE TABLE IF NOT EXISTS `leave_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `fk_leave_employee` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `users_id`, `start_date`, `end_date`, `reason`, `status`) VALUES
(1, 33, '2026-06-10', '2026-06-12', 'Personal', 'approved'),
(2, 33, '2026-06-15', '2026-06-16', 'Sick', 'approved'),
(3, 33, '2026-06-20', '2026-06-22', 'Family', 'rejected'),
(4, 33, '2026-06-25', '2026-06-26', 'Travel', 'approved'),
(5, 33, '2026-06-27', '2026-06-28', 'Personal', 'pending'),
(6, 33, '2026-07-01', '2026-07-02', 'Sick', 'approved'),
(7, 33, '2026-07-03', '2026-07-04', 'Family', 'approved'),
(8, 33, '2026-07-05', '2026-07-06', 'Travel', 'pending'),
(9, 33, '2026-07-07', '2026-07-08', 'Personal', 'approved'),
(10, 33, '2026-07-09', '2026-07-10', 'Sick', 'approved'),
(11, 33, '2026-07-11', '2026-07-12', 'Family', 'pending'),
(12, 33, '2026-07-13', '2026-07-14', 'Travel', 'approved'),
(13, 33, '2026-07-15', '2026-07-16', 'Personal', 'approved'),
(14, 33, '2026-07-17', '2026-07-18', 'Sick', 'rejected'),
(15, 33, '2026-07-19', '2026-07-20', 'Family', 'approved'),
(16, 33, '2026-07-21', '2026-07-22', 'Travel', 'approved'),
(17, 33, '2026-07-23', '2026-07-24', 'Personal', 'pending'),
(18, 33, '2026-07-25', '2026-07-26', 'Sick', 'approved'),
(19, 33, '2026-07-27', '2026-07-28', 'Family', 'approved'),
(20, 33, '2026-07-29', '2026-07-30', 'Travel', 'approved');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payrolls`
--

DROP TABLE IF EXISTS `payrolls`;
CREATE TABLE IF NOT EXISTS `payrolls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `base_salary` int(11) NOT NULL,
  `bonus` int(11) DEFAULT 0,
  `deduction` int(11) DEFAULT 0,
  `total_salary` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_id` (`employee_id`,`month`,`year`),
  KEY `fk_user_payroll` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payrolls`
--

INSERT INTO `payrolls` (`id`, `employee_id`, `month`, `year`, `base_salary`, `bonus`, `deduction`, `total_salary`, `users_id`) VALUES
(4, 4, 6, 2026, 9500000, 0, 0, 9500000, 21),
(5, 5, 6, 2026, 9000000, 0, 0, 9000000, 21),
(6, 6, 6, 2026, 10000000, 0, 0, 10000000, 21),
(7, 7, 6, 2026, 8500000, 0, 0, 8500000, 21),
(8, 8, 6, 2026, 10000000, 0, 0, 10000000, 21),
(9, 9, 6, 2026, 12000000, 0, 0, 12000000, 21),
(10, 10, 6, 2026, 18000000, 0, 0, 18000000, 21),
(11, 11, 6, 2026, 8500000, 0, 0, 8500000, 21),
(12, 12, 6, 2026, 7000000, 0, 0, 7000000, 21),
(13, 13, 6, 2026, 7500000, 0, 0, 7500000, 21),
(14, 14, 6, 2026, 14000000, 0, 0, 14000000, 21),
(15, 15, 6, 2026, 15000000, 0, 0, 15000000, 21),
(16, 16, 6, 2026, 8000000, 0, 0, 8000000, 21),
(17, 17, 6, 2026, 4000000, 0, 0, 4000000, 21),
(18, 18, 6, 2026, 13000000, 0, 0, 13000000, 21),
(19, 19, 6, 2026, 9000000, 0, 0, 9000000, 21),
(20, 20, 6, 2026, 12000000, 0, 0, 12000000, 21),
(21, 1, 6, 2026, 10000000, 1000000, 0, 11000000, 21),
(25, 2, 6, 2026, 20000000, 0, 200000, 19800000, 21),
(26, 3, 6, 2026, 10000000, 0, 500000, 9500000, 21),
(27, 1, 5, 2026, 12000000, 1000000, 0, 13000000, 21),
(28, 2, 5, 2026, 20000000, 0, 200000, 19800000, 21),
(29, 3, 5, 2026, 10000000, 0, 0, 10000000, 21);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `base_salary` int(11) NOT NULL DEFAULT 0,
  `max_salary` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `fk_user_position` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `positions`
--

INSERT INTO `positions` (`id`, `name`, `base_salary`, `max_salary`, `users_id`) VALUES
(1, 'Trưởng phòng hệ thống thông tin', 20000000, 30000000, 21),
(2, 'Trưởng phòng Test', 10000000, 20000000, 21),
(3, 'Trưởng phòng Dev', 15000000, 20000000, 21),
(4, 'Nhân viên senior', 12000000, 20000000, 21),
(6, 'Nhân viên junior', 8000000, 10000000, 21),
(9, 'Trưởng phòng quản lý nhân sự', 9000000, 15000000, 21),
(10, 'Lập trình viên', 15000000, 30000000, 21),
(11, 'Kiểm thử viên', 12000000, 20000000, 21),
(13, 'Nhân viên phòng marketing', 9500000, 11000000, 21),
(14, 'Nhân viên phòng sales', 9000000, 15000000, 21);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reward_discipline`
--

DROP TABLE IF EXISTS `reward_discipline`;
CREATE TABLE IF NOT EXISTS `reward_discipline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `type` enum('reward','discipline') NOT NULL,
  `title` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `decision_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_employee_reward_discipline` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `reward_discipline`
--

INSERT INTO `reward_discipline` (`id`, `employee_id`, `type`, `title`, `amount`, `decision_date`) VALUES
(1, 1, 'reward', 'Nhân viên xuất sắc tháng 6', 500000, '2026-06-17'),
(2, 2, 'discipline', 'Đi trễ nhiều lần', 200000, '2026-06-17'),
(8, 1, 'reward', 'Thưởng tăng ca tháng 6', 500000, '2026-06-17'),
(9, 3, 'discipline', 'Không đạt chỉ tiêu công việc', 500000, '2026-06-17'),
(10, 1, 'reward', 'Nhân viên xuất sắc tháng 5', 500000, '2026-05-21'),
(11, 1, 'reward', 'Thưởng tăng ca tháng 5', 500000, '2026-05-22'),
(12, 2, 'discipline', 'Đi trễ nhiều lần', 200000, '2026-05-10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'admin', 'quyen admin'),
(2, 'hcns', 'quyen phong hanh chinh nhan su'),
(3, 'qlcl', 'quyen phong quan ly chat luong'),
(4, 'httt', 'quyen phong he thong thong tin'),
(5, 'user', 'quyen nhan vien');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('active','suspend') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_users_role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `password`, `status`) VALUES
(21, 2, 'Nguyễn Văn Dũng', 'hr01@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(22, 5, 'Ngô Văn Uyên', 'emp02@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(23, 5, 'Đỗ Thị Thảo', 'emp03@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(24, 5, 'Bùi Văn Sang', 'emp04@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(25, 5, 'Đặng Thị Hoa', 'emp05@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(26, 5, 'Hoàng Văn Quyết', 'emp06@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(27, 5, 'Lê Thị Phương', 'emp07@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(28, 5, 'Phạm Văn Oanh', 'emp08@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(29, 5, 'Nguyễn Thị Tuyết Nga', 'emp09@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(30, 5, 'Trần Văn Mười', 'emp10@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(31, 5, 'Nguyễn Minh Lợi', 'emp11@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(32, 5, 'Ngô Thị Tuyết', 'emp12@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(33, 5, 'Đỗ Văn Long', 'emp13@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(34, 5, 'Bùi Thị Hoa', 'emp14@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(35, 5, 'Đặng Văn Giáp', 'emp15@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(36, 3, 'Võ Thị Phương', 'qlcl16@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(37, 5, 'Hoàng Văn Anh', 'emp17@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(38, 5, 'Phạm Thị Dung', 'emp18@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(39, 5, 'Lê Văn Chính', 'emp19@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(40, 5, 'Trần Thị Tuyết', 'emp20@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(41, 1, 'Admin', 'admin@gmail.com', '$2y$12$b4TXhGnr1UMenUb/kareg.xFcIwv1BouJc7zvgf3Nu2wC0H3mrSAW', 'active'),
(44, 4, 'Quy', 'httt@gmail.com', '$2y$12$b4TXhGnr1UMenUb/kareg.xFcIwv1BouJc7zvgf3Nu2wC0H3mrSAW', 'active'),
(45, 5, 'Trần Thị Mười', 'emp01@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(46, 5, 'Nguyễn Xuân Huỳnh', 'emp16@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active'),
(47, 5, 'Lê Phong', 'emp21@gmail.com', '$2y$12$FJzCOS81/aDXZpEkdRoACeXnCYRAiLkXszk6p0wLFgRm5D2GQcHVS', 'active');

--
-- Ràng buộc đối với các bảng kết xuất
--

--
-- Ràng buộc cho bảng `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `fk_attendance_user` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `fk_user_candidate` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `fk_contract_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_contract_user` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `fk_user_department` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk_employee_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_employee_position` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_employee` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `employee_certificates`
--
ALTER TABLE `employee_certificates`
  ADD CONSTRAINT `employee_certificates_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `fk_leave_user` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `payrolls`
--
ALTER TABLE `payrolls`
  ADD CONSTRAINT `fk_employee_payroll` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_payroll` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `fk_user_position` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `reward_discipline`
--
ALTER TABLE `reward_discipline`
  ADD CONSTRAINT `fk_employee_reward_discipline` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
