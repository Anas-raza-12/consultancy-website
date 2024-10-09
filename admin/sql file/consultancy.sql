/*
Navicat MySQL Data Transfer

Source Server         : My Connection
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : consultancy

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-09-10 19:04:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `job_form_data`
-- ----------------------------
DROP TABLE IF EXISTS `job_form_data`;
CREATE TABLE `job_form_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `cover_letter` text DEFAULT NULL,
  `identity_card` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `expected_salary` int(7) NOT NULL,
  `current_salary` int(7) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `education` varchar(150) NOT NULL,
  `certification` varchar(255) DEFAULT '',
  `language` varchar(100) NOT NULL,
  `candi_image` varchar(255) NOT NULL,
  `socialLink` varchar(255) DEFAULT NULL,
  `linkedIn` varchar(255) DEFAULT NULL,
  `cv` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of job_form_data
-- ----------------------------
INSERT INTO `job_form_data` VALUES ('1', 'Muhammad', 'Zubair', 'admin@example.com', '03242996774', 'male', 'Test', 'dc0e8c2945586f04d8ee49444b07133e.jpg', 'Karachi Pakistan', '65000', '40000', 'PHP Developer', 'Intermediate', 'Test', 'Urdu', '090f4cd77bb2b7ddc5fa571028278beb.png', 'Test,Test', 'Test,Test', '3c5a415af353693a675ef87e25360425.pdf');
INSERT INTO `job_form_data` VALUES ('2', 'Muhammad', 'Zubair', 'admin@example.com', '03242996774', 'male', 'Test', '56ea44bf50795fa602d117f2b60b8f71.jpg', 'Karachi Pakistan', '65000', '40000', 'PHP Developer', 'Intermediate', 'Test', 'Urdu', '', 'Test,Test', 'Test,Test', '6d40f80c347bea289b3c33eb68e2f8cf.pdf');
INSERT INTO `job_form_data` VALUES ('3', 'Muhammad', 'Zubair', 'admin@example.com', '03242996774', 'male', 'Test', '172d82977839b735054eccddcdffc433.jpg', 'Karachi Pakistan', '65000', '40000', 'PHP Developer', 'Intermediate', 'Test', 'Urdu', '', 'Test,Test', 'Test,Test', '47f53cbe8d5bb85abc13679fafd26946.pdf');
INSERT INTO `job_form_data` VALUES ('4', 'Muhammad', 'Zubair', 'admin@example.com', '03242996774', 'male', 'Test', 'ba24c2d43b78d9b6601d5c54893976bd.jpg', 'Karachi Pakistan', '65000', '40000', 'PHP Developer', 'Intermediate', 'Test', 'Urdu', 'cbe9148be67bc88239a0458ffc1c6621.jpg', 'Test,Test', 'Test,Test', 'b38abfa769145e9e8efa8a2fc4f3ff88.pdf');
INSERT INTO `job_form_data` VALUES ('5', 'Muhammad', 'Zubair', 'admin@example.com', '03242996774', 'male', 'Test', 'a3e2f13320e148148fba079d6d5b65f7.jpg', 'Karachi Pakistan', '65000', '40000', 'PHP Developer', 'Intermediate', 'Test', 'Urdu', '2c834e0935d684332549aff65a3109b2.jpg', 'Test,Test', 'Test,Test', '405ac46c91d29cde0569de7e07e95dc3.pdf');
INSERT INTO `job_form_data` VALUES ('6', 'Muhammad', 'Zubair', 'admin@example.com', '03242996774', 'male', 'Test', '09ef49300a73e7fd184f46c6abd66ae8.jpg', 'Karachi Pakistan', '65000', '40000', 'PHP Developer', 'Intermediate', 'Test', 'Urdu', 'e9060cf1afcff91599bfba399937e07f.jpg', 'Test,Test', 'Test,Test', 'c3fe436e42aa255921c1cefcd2b182f2.pdf');

-- ----------------------------
-- Table structure for `job_form_details`
-- ----------------------------
DROP TABLE IF EXISTS `job_form_details`;
CREATE TABLE `job_form_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `age` int(2) NOT NULL,
  `religion` varchar(20) DEFAULT NULL,
  `gender` varchar(10) NOT NULL DEFAULT '',
  `dob` date DEFAULT NULL,
  `cv` varchar(255) NOT NULL DEFAULT '',
  `cover_letter` text NOT NULL,
  `identity_card` varchar(255) NOT NULL DEFAULT '',
  `current_status` varchar(12) NOT NULL DEFAULT '',
  `job_type` varchar(50) NOT NULL DEFAULT '',
  `address` varchar(100) NOT NULL DEFAULT '',
  `country` varchar(56) NOT NULL DEFAULT '',
  `city` varchar(100) NOT NULL DEFAULT '',
  `university` varchar(100) NOT NULL DEFAULT '',
  `degree` varchar(25) NOT NULL DEFAULT '',
  `deg_start` date NOT NULL,
  `deg_end` date DEFAULT NULL,
  `deg_ongoing` int(1) DEFAULT NULL,
  `linkedin` varchar(255) NOT NULL DEFAULT '',
  `twitter` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `github` varchar(255) NOT NULL DEFAULT '',
  `pre_work_title` varchar(25) NOT NULL DEFAULT '',
  `company_name` varchar(255) NOT NULL DEFAULT '',
  `pre_work_sdate` date NOT NULL,
  `pre_work_edate` date DEFAULT NULL,
  `apply_position` varchar(25) NOT NULL DEFAULT '',
  `applied_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'applied',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of job_form_details
-- ----------------------------
INSERT INTO `job_form_details` VALUES ('1', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:31:27', 'applied');
INSERT INTO `job_form_details` VALUES ('2', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:32:06', 'applied');
INSERT INTO `job_form_details` VALUES ('3', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:32:07', 'applied');
INSERT INTO `job_form_details` VALUES ('4', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:32:07', 'applied');
INSERT INTO `job_form_details` VALUES ('5', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:32:08', 'applied');
INSERT INTO `job_form_details` VALUES ('6', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:32:09', 'applied');
INSERT INTO `job_form_details` VALUES ('7', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:32:10', 'applied');
INSERT INTO `job_form_details` VALUES ('8', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:32:11', 'applied');
INSERT INTO `job_form_details` VALUES ('9', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:32:57', 'applied');
INSERT INTO `job_form_details` VALUES ('10', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:32:58', 'applied');
INSERT INTO `job_form_details` VALUES ('11', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:32:59', 'applied');
INSERT INTO `job_form_details` VALUES ('12', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:33:00', 'applied');
INSERT INTO `job_form_details` VALUES ('13', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:33:00', 'applied');
INSERT INTO `job_form_details` VALUES ('14', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:33:01', 'applied');
INSERT INTO `job_form_details` VALUES ('15', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:33:01', 'applied');
INSERT INTO `job_form_details` VALUES ('16', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:33:02', 'applied');
INSERT INTO `job_form_details` VALUES ('17', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:33:03', 'applied');
INSERT INTO `job_form_details` VALUES ('18', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:33:03', 'applied');
INSERT INTO `job_form_details` VALUES ('19', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:33:04', 'applied');
INSERT INTO `job_form_details` VALUES ('20', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:33:04', 'applied');
INSERT INTO `job_form_details` VALUES ('21', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:33:05', 'applied');
INSERT INTO `job_form_details` VALUES ('22', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:33:05', 'applied');
INSERT INTO `job_form_details` VALUES ('23', 'John Doe', 'john.doe@example.com', '+1234567890', '19', 'Christianity', 'Male', '1990-01-01', 'link_to_cv.pdf', 'link_to_cover_letter.pdf', 'link_to_identity_card.jpg', 'Employed', 'Full-Time', '1234 Main St, Springfield, IL', 'USA', 'Springfield', 'Springfield University', 'Bachelor\'s in Computer Sc', '2008-09-01', '2012-06-01', '1', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2015-01-01', '2020-12-31', 'Senior Software Developer', '2024-08-05 16:33:06', 'applied');
INSERT INTO `job_form_details` VALUES ('24', 'Dummy Product', 'zubairarain335@gmail.com', '03242996774', '15', 'Islam', 'Male', '2024-08-09', 'uploads/66b5c914be6ff.pdf', 'Test', 'sd5454', 'sadg', 'sdag', 'sdagsa', 'sadgsad', 'sdag', 'sgdsad', 'sadg', '2024-08-09', '2024-08-09', '1', 'sdagsad', 'sadgsadg', 'sdgsad', 'sadgsa', 'sadgsad', 'sadgsadg', '2024-08-09', '2024-08-09', 'sadgsadg', '2024-08-09 12:45:24', 'applied');
INSERT INTO `job_form_details` VALUES ('25', 'Dummy Product 2', 'zubairarain335@gmail.com', '+923242996774', '15', 'Islam', 'Male', '2024-08-09', 'uploads/66b5e42a4d1c8.pdf', 'Test', 'sd5454', 'sadg', 'sdag', 'Al-Ramzan Home Hanfia Street Ranchore Line Karachi', 'Pakistan', 'Karachi', 'Jamia Al Dirasat Ul Islami Karachi', 'sadg', '2024-08-09', '2024-08-09', '1', 'sdagsad', 'sadgsadg', 'sdgsad', 'sadgsa', 'sadgsad', 'sadgsadg', '2024-08-09', '2024-08-09', 'sadgsadg', '2024-08-09 14:40:58', 'applied');
INSERT INTO `job_form_details` VALUES ('26', 'Dummy Product 2', 'zubairarain335@gmail.com', '+923242996774', '15', 'Islam', 'Male', '2024-08-09', 'uploads/66b5e52713292.pdf', 'Test', 'sd5454', 'sadg', 'sdag', 'Al-Ramzan Home Hanfia Street Ranchore Line Karachi', 'Pakistan', 'Karachi', 'Jamia Al Dirasat Ul Islami Karachi', 'sadg', '2024-08-09', '2024-08-09', '1', 'sdagsad', 'sadgsadg', 'sdgsad', 'sadgsa', 'sadgsad', 'sadgsadg', '2024-08-09', '2024-08-09', 'sadgsadg', '2024-08-09 14:45:11', 'applied');
INSERT INTO `job_form_details` VALUES ('27', 'Dummy Product', 'zubairarain335@gmail.com', '03242996774', '15', 'islam', 'Male', '2024-08-10', 'uploads/66b5e52713292.pdf', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque inventore ut eveniet reiciendis totam temporibus placeat eum veritatis suscipit! Excepturi animi velit suscipit nihil hic ea amet nulla expedita similique?\r\n                                        Obcaecati consequatur exercitationem pariatur tempore odit at accusantium tempora? Quam temporibus ad amet nesciunt voluptas fugiat, labore assumenda ratione perspiciatis pariatur iste porro praesentium accusantium, dolores aspernatur ab sit iusto.', 'sd5454', 'sadg', 'sdag', 'Al-Ramzan Home Hanfia Street Ranchore Line Karachi', 'Pakistan', 'Karachi', 'Capital University of Science & Technology', 'sadg', '2024-08-10', '2024-08-10', '1', 'sdagsad', 'sadgsadg', 'sdgsad', 'sadgsa', 'sadgsad', 'sadgsadg', '2024-08-10', '2024-08-10', 'sadgsadg', '2024-08-13 14:51:27', 'applied');
INSERT INTO `job_form_details` VALUES ('28', 'Muhammad Zubair', 'zubairarain335@gmail.com', '03242996774', '15', 'islam', 'Male', '2024-08-10', 'uploads/66b5e52713292.pdf', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque inventore ut eveniet reiciendis totam temporibus placeat eum veritatis suscipit! Excepturi animi velit suscipit nihil hic ea amet nulla expedita similique?', 'sd5454', 'sadg', 'sdag', 'Al-Ramzan Home Hanfia Street Ranchore Line Karachi', 'Pakistan', 'Karachi', 'Capital University of Science & Technology', 'sadg', '2024-08-10', '2024-08-10', '1', 'sdagsad', 'sdagsad', 'sdagsad', 'sdagsad', 'sdagsad', 'sdagsad', '2024-08-10', '2024-08-10', 'sadgsadg', '2024-08-13 14:52:15', 'applied');
INSERT INTO `job_form_details` VALUES ('29', '', '', '', '0', null, '', null, '', '                                        Obcaecati consequatur exercitationem pariatur tempore odit at accusantium tempora? Quam temporibus ad amet nesciunt voluptas fugiat, labore assumenda ratione perspiciatis pariatur iste porro praesentium accusantium, dolores aspernatur ab sit iusto.', '', '', '', '', '', '', '', '', '0000-00-00', null, null, '', null, null, '', '', '', '0000-00-00', null, '', '2024-08-13 14:51:35', 'applied');
INSERT INTO `job_form_details` VALUES ('30', 'Muhammad Zubair', 'zubairarain335@gmail.com', '03242996774', '15', 'Islam', 'Male', '2024-08-13', 'uploads/66bb2db6e5c50.pdf', 'Test', 'sd5454', 'sadg', 'sdag', 'Al-Ramzan Home Hanfia Street Ranchore Line Karachi', 'Pakistan', 'Karachi', 'Balochistan University of Engineering and Technology Khuzdar', 'sadg', '2024-08-13', '2024-08-13', '1', 'sdagsad', 'sadgsadg', 'sdgsad', 'sadgsa', 'sadgsad', 'sadgsadg', '2024-08-13', '2024-08-13', 'sadgsadg', '2024-08-13 14:56:06', 'applied');
INSERT INTO `job_form_details` VALUES ('31', 'Muhammad Zubair', 'zubairarain335@gmail.com', '03242996774', '15', 'Islam', 'Male', '2024-08-13', 'api/uploads/66bb2e015a6a0.pdf', 'Test', 'sd5454', 'sadg', 'sdag', 'Al-Ramzan Home Hanfia Street Ranchore Line Karachi', 'Pakistan', 'Karachi', 'Balochistan University of Engineering and Technology Khuzdar', 'sadg', '2024-08-13', '2024-08-13', '1', 'sdagsad', 'sadgsadg', 'sdgsad', 'sadgsa', 'sadgsad', 'sadgsadg', '2024-08-13', '2024-08-13', 'sadgsadg', '2024-08-13 14:57:21', 'applied');
INSERT INTO `job_form_details` VALUES ('32', 'John Doe', 'john.doe@example.com', '123-456-7890', '28', 'Christianity', 'Male', '1995-04-12', 'uploads/john_doe_cv.pdf', 'I am passionate about software development and eager to bring my skills to your team.', '123456789', 'Employed', 'Full-Time', '123 Main St, Springfield', 'USA', 'Springfield', 'State University', 'Bachelor\'s in Computer Sc', '2014-08-15', '2018-05-20', '0', 'https://www.linkedin.com/in/johndoe', 'https://twitter.com/johndoe', 'https://www.facebook.com/johndoe', 'https://github.com/johndoe', 'Software Developer', 'Tech Solutions Inc.', '2019-06-01', '2023-07-31', 'Senior Software Developer', '2024-08-13 15:22:20', 'applied');

-- ----------------------------
-- Table structure for `job_notifications`
-- ----------------------------
DROP TABLE IF EXISTS `job_notifications`;
CREATE TABLE `job_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of job_notifications
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '$2y$10$GJsLJXJMdAQVds6ybB72Qui3LkNtK/anSD00IAFqKZR47.gPMvFCK');
