-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 03, 2019 at 09:23 PM
-- Server version: 10.1.37-MariaDB-0+deb9u1
-- PHP Version: 7.0.33-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bcp`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `activity` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `activity`) VALUES
(1, 'Auditing'),
(2, 'Quality managing'),
(3, 'Review care plan\r\n'),
(4, 'Risk management'),
(13, 'Test'),
(14, 'Health');

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `id` int(11) NOT NULL,
  `catagory` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`id`, `catagory`) VALUES
(1, 'Clinical'),
(2, 'Corporate'),
(3, 'Core'),
(4, 'Infrastructure');

-- --------------------------------------------------------

--
-- Table structure for table `cat_func`
--

CREATE TABLE `cat_func` (
  `id` int(11) NOT NULL,
  `function` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `catagory` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cat_func`
--

INSERT INTO `cat_func` (`id`, `function`, `catagory`) VALUES
(1, 'Departmental', 'Clinical'),
(2, 'Radiology', 'Clinical'),
(3, 'Cancer services', 'Clinical'),
(4, 'Dental', 'Clinical'),
(5, 'Cardiology', 'Clinical'),
(6, 'Enterprise', 'Clinical'),
(7, 'Mobile Apps', 'Clinical'),
(8, 'Finance and supply', 'Corporate'),
(9, 'Quality and safety', 'Corporate'),
(10, 'Social', 'Corporate'),
(11, 'Health information', 'Corporate'),
(12, 'Workforce', 'Corporate'),
(13, 'Asset management', 'Corporate'),
(14, 'Information management', 'Corporate'),
(15, 'Mobile Apps', 'Corporate'),
(16, 'Data analytics', 'Core'),
(17, 'Integration', 'Core'),
(18, 'Telehealth', 'Core'),
(19, 'Dictation', 'Core'),
(20, 'Desktop', 'Core'),
(21, 'Patient Care', 'Core'),
(22, 'Cybersecurity', 'Core'),
(23, 'Access and productivity', 'Core'),
(24, 'Storage', 'Infrastructure'),
(25, 'Public cloud', 'Infrastructure'),
(26, 'Monitoring', 'Infrastructure'),
(27, 'Compute', 'Infrastructure'),
(28, 'Network', 'Infrastructure'),
(29, 'Communications', 'Infrastructure'),
(30, 'IT Asset management', 'Infrastructure');

-- --------------------------------------------------------

--
-- Table structure for table `clinical_program`
--

CREATE TABLE `clinical_program` (
  `id` int(11) NOT NULL,
  `clinical_unit` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `program` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clinical_program`
--

INSERT INTO `clinical_program` (`id`, `clinical_unit`, `program`) VALUES
(1, 'Aged Care Assessment\r\n', 'Aged Care\r\n'),
(2, 'Residential Care', 'Aged Care'),
(3, 'Residential in Reach\r\n', 'Aged Care'),
(4, 'Restorative Care Program', 'Aged Care'),
(5, 'Transition Care Program', 'Aged Care'),
(6, 'Transition Care Program', 'Aged Care'),
(7, 'Aboriginal Health', 'Allied Health '),
(8, 'Audiology', 'Allied Health '),
(9, 'Dietetics', 'Allied Health '),
(10, 'Occupational Therapy', 'Allied Health '),
(11, 'Orthotics and Prosthetics', 'Allied Health '),
(12, 'Pastoral Care', 'Allied Health '),
(13, 'Physiotherapy', 'Allied Health '),
(14, 'Podiatry', 'Allied Health '),
(15, 'Psychology/Neuropsych', 'Allied Health '),
(16, 'Social Work', 'Allied Health '),
(17, 'Speech Pathology', 'Allied Health '),
(18, 'Cancer', 'Cancer'),
(19, 'Haematology', 'Cancer'),
(20, 'Medical Oncology', 'Cancer'),
(21, 'Outpatients', 'Cancer'),
(22, 'Radiation Oncology', 'Cancer'),
(23, '\"Administration\"', 'Clinical Services'),
(24, '\"HR\"', 'Clinical Services'),
(25, 'Access & Resource', 'Clinical Services'),
(26, 'Clinical Trials Unit', 'Clinical Services'),
(27, 'Finance', 'Clinical Services'),
(28, 'Hospital in the Home', 'Clinical Services'),
(29, 'Infectious Diseases', 'Clinical Services'),
(30, 'Medical Imaging', 'Clinical Services'),
(31, 'Outpatients', 'Clinical Services'),
(32, 'Pharmacy', 'Clinical Services'),
(33, 'Carer Support', 'Community'),
(34, 'Community Nursing', 'Community'),
(35, 'Community Rehabilitation', 'Community'),
(36, 'Day Programs', 'Community'),
(37, 'Health Promotion Unit', 'Community'),
(38, 'Home Based Rehabilitation', 'Community'),
(39, 'Hospital Admission Risk Program', 'Community'),
(40, 'Hydrotherapy', 'Community'),
(41, 'Immunisation', 'Community'),
(42, 'Information and Access', 'Community'),
(43, 'Oral Health', 'Community'),
(44, 'Personalised Health Care', 'Community'),
(45, 'Primary Care', 'Community'),
(46, 'Refugee Health', 'Community'),
(47, 'Regional ABI', 'Community'),
(48, 'Respecting Patient Choices', 'Community'),
(49, 'Paediatric Rehabilitation', 'Community'),
(50, 'Cardiology', 'Critical Care and Specialist '),
(51, 'Cardio-Thoracic', 'Critical Care and Specialist '),
(52, 'Endocrinology', 'Critical Care and Specialist '),
(53, 'Intensive Care', 'Critical Care and Specialist '),
(54, 'Neurosciences', 'Critical Care and Specialist '),
(55, 'Opthalmology', 'Critical Care and Specialist '),
(56, 'Renal', 'Critical Care and Specialist '),
(57, 'Vasuclar', 'Critical Care and Specialist '),
(58, 'Dermatology', 'Emergency and Medicine'),
(59, 'Emergency Medicine', 'Emergency and Medicine'),
(60, 'Gastroenterology', 'Emergency and Medicine'),
(61, 'General Medicine', 'Emergency and Medicine'),
(62, 'Geriatric Medicine', 'Emergency and Medicine'),
(63, 'Rapid Assessment and Planning', 'Emergency and Medicine'),
(64, 'Respiratory', 'Emergency and Medicine'),
(65, 'Rheumatology', 'Emergency and Medicine'),
(66, 'Access Team', 'Mental Health'),
(67, 'Acute Mental Health', 'Mental Health'),
(68, 'Adult Mental Health', 'Mental Health'),
(69, 'Aged Psychiatry', 'Mental Health'),
(70, 'Child Youth', 'Mental Health'),
(71, 'Clozapine team', 'Mental Health'),
(72, 'Consultation and Liaison', 'Mental Health'),
(73, 'Consumer and Carer Consult', 'Mental Health'),
(74, 'Eating Disorder Service', 'Mental Health'),
(75, 'Eating Disorder Service', 'Mental Health'),
(76, 'Forensic/SECU', 'Mental Health'),
(77, 'HOPS', 'Mental Health'),
(78, 'Perinatal Emotional Health ', 'Mental Health'),
(79, 'Psychology Clinic', 'Mental Health'),
(80, 'Subacute Mental Health', 'Mental Health'),
(81, 'Acute Consulting', 'Palliative Care'),
(82, 'Cachexia clinic', 'Palliative Care'),
(83, 'Clinical Trials Unit', 'Palliative Care'),
(84, 'Community', 'Palliative Care'),
(85, 'Inpatient', 'Palliative Care'),
(86, 'Specialist Clinics', 'Palliative Care'),
(87, 'GEM', 'Rehabilitation'),
(88, 'Rehabilitation', 'Rehabilitation'),
(89, 'Cognitive, dementia and memory', 'Specialist Clinics'),
(90, 'Continence Clinic', 'Specialist Clinics'),
(91, 'Falls and balance clinc', 'Specialist Clinics'),
(92, 'Multiple Sclerosis clinic', 'Specialist Clinics'),
(93, 'Progressive Neurological ', 'Specialist Clinics'),
(94, 'Transition Clinic', 'Specialist Clinics'),
(95, 'Anaesthesia and Pain', 'Surgical Services'),
(96, 'Elective Surgery Access', 'Surgical Services'),
(97, 'General Surgery', 'Surgical Services'),
(98, 'Operating Services', 'Surgical Services'),
(99, 'Oral and Max-Facial', 'Surgical Services'),
(100, 'Orthopaedics', 'Surgical Services'),
(101, 'Otolaryngology', 'Surgical Services'),
(102, 'Plasics and Reconstructive', 'Surgical Services'),
(103, 'Birthing Suite', 'Womens and Childrens'),
(104, 'Children\'s', 'Womens and Childrens'),
(105, 'Gynecological Surgery', 'Womens and Childrens'),
(106, 'Obstetrics and Maternity', 'Womens and Childrens'),
(107, 'Paediatric Surgery', 'Womens and Childrens'),
(108, 'Special Care Nursery', 'Womens and Childrens'),
(109, 'All', 'Building and Engineering'),
(110, 'All', 'Clinical Engineering'),
(111, 'Switchboard', 'Clinical Engineering'),
(112, 'All', 'Corporate Office'),
(113, 'Govt Reporting', 'Data and Analytics'),
(114, 'Finance', 'Data and Analytics'),
(115, 'All', 'Data and Analytics'),
(116, 'All', 'Education and Training'),
(117, 'Finance', 'Finance'),
(118, 'Clinical Eng.', 'Finance'),
(119, 'Building/Eng.', 'Finance'),
(120, 'All', 'Finance'),
(121, 'All', 'Food Services'),
(122, 'Coding & Medical Records', 'Health Information'),
(123, 'Medical Records', 'Health Information'),
(124, 'All', 'Health Information'),
(125, 'All', 'Information Technology'),
(126, 'All', 'Library Services'),
(127, 'All', 'Project Management'),
(128, 'All', 'Research'),
(129, 'All', 'Safety and Quality'),
(130, 'Consumer Liaison', 'Safety and Quality'),
(131, 'All', 'Supply'),
(132, 'All', 'Support Services'),
(133, 'All', 'Workforce and Culture');

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `mail_host` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_port` int(5) NOT NULL,
  `mail_use_auth` tinyint(1) NOT NULL,
  `mail_username` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_from_addr` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `self_register` tinyint(1) NOT NULL,
  `self_reg_priv_level` int(11) NOT NULL,
  `domain_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id`, `mail_host`, `mail_port`, `mail_use_auth`, `mail_username`, `mail_password`, `mail_from_addr`, `self_register`, `self_reg_priv_level`, `domain_name`) VALUES
(0, 'ssl://mail.internode.on.net', 465, 1, 'mclennan@internode.on.net', 'Qwaszx01', 'bcp_admin@sit764.killersoft.net', 1, 100, 'sit764.killersoft.net');

-- --------------------------------------------------------

--
-- Table structure for table `dependancy_rating`
--

CREATE TABLE `dependancy_rating` (
  `scale` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dependancy_rating`
--

INSERT INTO `dependancy_rating` (`scale`, `level`, `description`, `summary`, `id`) VALUES
('Min\r\n', '<10%\r\n', 'There is minimal dependency on this resource.  System is nice to have; successful delivery of critical services or completion of a task is possible without this resource.\r\n', 'Minimal dependence\r\n', 1),
('Low\r\n', '25%\r\n', 'There is low dependency on this systemfor the successful provision of critical services or completion of a task; an outage will have minimal material impact; the task can still be successfully completed using manual workarounds or alternative resources as a stop gap measure until the systemis available again.\r\n', 'Low dependence\r\n', 2),
('Some\r\n', '50%\r\n', 'Successful delivery of critical services or completion of a task is occasionally dependent on this resource; an outage may cause some inconvenient delays in completion of a task but parts of the task can be successfully completed using manual procedures or alternative resources for a period of time.\r\n', 'Sometimes dependent\r\n', 3),
('Full\r\n', '75%\r\n', 'Successful delivery of a critical service is fully dependant on this resource; system is used regularly for processing; an outage may result in significant knock on effects; there is low tolerance of an outage before the impact becomes unacceptable; limited manual workaround or alternative systemmay be used for a short period of time as a stop gap measure.\r\n', 'Fully dependent\r\n', 4),
('Critical\r\n', '100%\r\n', 'Successful delivery of a critical service is fully dependant on this resource; system is used continuously for processing or to provide real time feedback/information; systemmust be operational 24 x 7; an outage may result in serious knock on effects; there is close to zero tolerance of an outage before it becomes unacceptable; there are no or very limited manual workaround or alternative resources.\r\n', 'Critically Dependent\r\n', 5);

-- --------------------------------------------------------

--
-- Table structure for table `impact_reference`
--

CREATE TABLE `impact_reference` (
  `IR` int(11) NOT NULL,
  `People_Effects` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Financial_Impact` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Reputation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Service_Outputs` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Legal_Compliance` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Management_Impact` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `impact_reference`
--

INSERT INTO `impact_reference` (`IR`, `People_Effects`, `Financial_Impact`, `Reputation`, `Service_Outputs`, `Legal_Compliance`, `Management_Impact`, `id`) VALUES
(5, 'One or more fatalities or severe irreversible disability to one or more people.', 'loss > than 10% of monthly revenue budget.\r\n', 'National media coverage; Significant impact on funding for several years; long- term loss of clients.\r\n', 'Total cessation of multiple services for many months.', '\"Major litigation costing\r\n$>3m; Investigation by regulatory body resulting in long term interruption of operations\".\r\n', 'Restructuring of organization with loss of many senior managers.\r\n', 1),
(4, 'Extensive injury or impairment to one or more persons.\r\n', 'loss > than 5% monthly revenue budget.', 'State media coverage; CEO departs affecting funding or causing loss of clients for many months.', 'Disruption of multiple services for several months.', 'Major breach of regulation with punitive fine, and significant litigation involving many weeks of senior management time and up to $3m legal costs.', 'Significant disruption that will require considerable senior management time over several weeks.\r\n', 2),
(3, 'Short term disability to one or more persons.', 'loss > than 2% of monthly revenue budget.', 'Local media coverage over several days; senior managers departs.', 'Total cessation of one service for a few months.', 'Breach of regulation with investigation by authority and possible major fine, and litigation and legal costs up to $999k.', 'Disruption that will require senior management time over several weeks.', 3),
(2, 'Significant medical treatment : lost time injury < 2 weeks.', 'loss < than 2% of monthly revenue budget.', 'Local media coverage, and complaint to management.', 'Some service disruption in the area.', 'Breach of regulations; moderate fine or legal costs; minor litigation.', 'Will require some senior management time over many days.', 4),
(1, 'First aid, or minor treatment.', '< than 1% of monthly revenue budget.', 'No media coverage; complaint to employee.', 'Minimal disruption.', 'Minor legal issues or breach of regulations.', 'Will require some management attention.', 5);

-- --------------------------------------------------------

--
-- Table structure for table `mtdp`
--

CREATE TABLE `mtdp` (
  `mtpd` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `criteria` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mtdp`
--

INSERT INTO `mtdp` (`mtpd`, `criteria`, `id`) VALUES
('Nil', 'l', 1),
('2 Hr\r\n', 'H\r\n', 2),
('4 Hr\r\n', 'H', 3),
('8 Hr\r\n', 'D', 7),
('1 Day\r\n', 'D', 8),
('3 Days', 'W', 9),
('1 Week', 'W', 10),
('2 Weeks', 'M', 11),
('1 Month', '', 12);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `program_name` varchar(64) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `program_name`) VALUES
(1, 'Aged Care'),
(2, 'Allied Health'),
(3, 'Cancer'),
(4, 'Community'),
(5, 'Critical Care and Specialist '),
(6, 'Emergency and Medicine'),
(7, 'Clinical Services'),
(8, 'Mental Health'),
(9, 'Palliative Care'),
(10, 'Rehabilitation'),
(11, 'Specialist Clinics'),
(12, 'Cancer Service '),
(13, 'Surgical Services'),
(14, 'Womens and Childrens'),
(16, 'Building and Engineering'),
(17, 'Clinical Engineering'),
(18, 'Corporate Office'),
(19, 'Data and Analytics'),
(20, 'Education and Training'),
(21, 'Finance'),
(22, 'Food Services'),
(23, 'Health Information'),
(24, 'Information Technology'),
(25, 'Library Services'),
(26, 'Project Management'),
(27, 'Research'),
(28, 'Safety and Quality'),
(29, 'Supply'),
(30, 'Support Services'),
(31, 'Workforce and Culture'),
(32, 'Spare');

-- --------------------------------------------------------

--
-- Table structure for table `system_register`
--

CREATE TABLE `system_register` (
  `id` int(11) NOT NULL,
  `it_system_name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `it_system_description` text COLLATE utf8mb4_unicode_ci,
  `class` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `catagory` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `function` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_register`
--

INSERT INTO `system_register` (`id`, `it_system_name`, `it_system_description`, `class`, `catagory`, `function`) VALUES
(1, 'ARM', 'ARM', '', 'Corporate', 'Finance and supply'),
(2, 'ASCOM', 'Duress Alarm System', '', 'Core', ''),
(3, 'Asset Plus', 'Asset Management System', '', 'Corporate', ''),
(4, 'Benefits Plus', 'Salaray Packaging System', '', 'Corporate', ''),
(5, 'Ent. Reporting', 'Reporting Platform', '', 'Infrastructure', ''),
(6, 'BOS', 'Maternity Information System', '', 'Clinical', 'Departmental'),
(7, 'BOSSnet', 'Digital Medical Record', '', 'Clinical', 'Departmental'),
(8, 'Carriers', 'Telecommunications', '', 'Infrastructure', ''),
(9, 'CBoard', 'Meal Management System', '', 'Corporate', ''),
(10, 'CGOV', 'Quality and Safety system', '', 'Corporate', ''),
(11, 'Charm', 'Oncology Information System', '', 'Clinical', 'Cancer services'),
(12, 'Chemalert', 'Chemical Mgt Database', '', 'Clinical', ''),
(13, 'Citrix', 'Citrix', '', 'Core', 'Desktop'),
(14, 'Codefinder', '3M Codefinder', '', 'Corporate', ''),
(15, 'Cogent', 'Cleaning Audit Tool', '', 'Corporate', ''),
(16, 'CORDIS', 'Endocrinology', '', 'Clinical', 'Departmental'),
(17, 'Dataworx', 'Voice recording and transcription System', '', 'Core', ''),
(18, 'DocLink', 'DocLink', '', 'Corporate', 'Finance and supply'),
(19, 'Elumina', 'Injury Mgt Database', '', 'Corporate', ''),
(20, 'eMail', 'eMail', '', 'Infrastructure', ''),
(21, 'Epicor', 'Finance & Procurement', '', 'Corporate', 'Finance and supply'),
(22, 'eVMS', 'Fee Paymeny System', '', 'Corporate', ''),
(23, 'FirstNet/Symphony', 'Emergency Department Information System', '', 'Clinical', 'Departmental'),
(24, 'FPC', 'Patient Journey Board', '', 'Core', 'Patient Care'),
(25, 'GROW', 'LMS', '', 'Corporate', ''),
(26, 'Heart', 'Data Warehouse', '', 'Core', ''),
(27, 'Honeywell', 'BMS', '', 'Corporate', ''),
(28, 'hTrak', 'Purchasing', '', 'Corporate', 'Finance and supply'),
(29, 'Internet', 'Internet Gateway', '', 'Infrastructure', 'Network'),
(30, 'iPM', 'Patient Administration System', '', 'Clinical', 'Departmental'),
(31, 'IPTel', 'IP Telephony', '', 'Infrastructure', 'Communications'),
(32, 'JCAPS', 'Data Integration', '', 'Core', ''),
(33, 'LawMan', 'Linnen database', '', 'Corporate', ''),
(34, 'McKesson', 'Cardiology', '', 'Clinical', 'Cardiology'),
(35, 'Medibill', 'Billing', '', 'Corporate', 'Finance and supply'),
(36, 'Mercury', 'Talent mgt system', '', 'Corporate', ''),
(37, 'Merlin', 'Medications Management System', '', 'Clinical', 'Departmental'),
(38, 'Mobile', 'Mobile Telephone', '', 'Infrastructure', ''),
(39, 'NAB Online', 'Internet Banking', '', 'Infrastructure', ''),
(40, 'OBTraceVue', 'Life Monitoring System', '', 'Clinical', ''),
(41, 'PayGlobal', 'Payroll system', '', 'Corporate', 'Finance and supply'),
(42, 'PeopleKey', 'Time capture systems', '', 'Corporate', ''),
(43, 'PERM', 'Palliative Care Information System', '', 'Clinical', 'Departmental'),
(44, 'PJB', 'Community Information System', '', 'Clinical', 'Departmental'),
(45, 'Platinum 5', 'Aged Care Information System', '', 'Clinical', 'Departmental'),
(46, 'Power budget', 'Finance system', '', 'Corporate', 'Finance and supply'),
(47, 'Print', 'Printing', '', 'Core', 'Desktop'),
(48, 'PulseNET', 'Messaging service', '', 'Core', 'Integration'),
(49, 'Pyxis', 'Automated drug cabinets', '', 'Core', ''),
(50, 'Qdoc', 'Agfa Qdoc', '', 'Core', ''),
(51, 'RenalNET', 'Renal Information System', '', 'Clinical', 'Departmental'),
(52, 'Responder', 'Nurse Call', '', 'Core', 'Patient Care'),
(53, 'RiskMan', 'Incident Mgt System', '', 'Corporate', ''),
(54, 'Sharepoint', 'Document Mgt Systems', '', '', ''),
(55, 'Shiftmatch', 'Resource Mgt System', '', 'Corporate', ''),
(56, 'SLIC', 'ICU Information System', '', 'Clinical', 'Departmental'),
(57, 'Soliton', 'Image reporting', '', 'Core', ''),
(58, 'SWIPE', 'Security Access System', '', 'Core', ''),
(59, 'SyberScribe', 'Transcription service', '', 'Core', ''),
(60, 'Synapse', 'Medical Imaging -Synapse', '', 'Clinical', 'Radiology'),
(61, 'TCM', 'Mental Health / HARP /Carer Respite', '', 'Clinical', 'Departmental'),
(62, 'Titanium', 'Dental', '', 'Clinical', 'Dental'),
(63, 'WorkForceWatch', 'Case Mgt System', '', 'Corporate', ''),
(64, 'Xcom', 'Paging system', '', 'Corporate', ''),
(65, 'Zeacom', 'IVR', '', 'Infrastructure', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation_date` date NOT NULL,
  `last_login` date NOT NULL,
  `confirm_code` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_active` tinyint(1) NOT NULL,
  `user_priv_level` int(4) NOT NULL,
  `email_confirmed` tinyint(1) NOT NULL,
  `account_administratively_disabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `creation_date`, `last_login`, `confirm_code`, `account_active`, `user_priv_level`, `email_confirmed`, `account_administratively_disabled`) VALUES
(14, 'deakin', '60fee1c5df17c78fcb2c36c6cbc6a0ae1d1a3a948e4e31998419214aff667522', 'deakin@deakin.edu.au', 'The', 'admin', '2019-01-01', '2019-02-03', '25ccc737b3cdbc2ec28b40319fc62f62f44446bf3d3e5212596f24dec4d11e75', 1, 100, 1, 0),
(40, 'jmurphy', '7e19e31ae82d749034fc921f777f717ba5b57c6add9add889eb536ac6effcde0', 'jmurphy@deakin.edu.au', 'john', 'murphy', '2019-01-08', '2019-02-03', '', 1, 100, 0, 0),
(43, 'iman', '2e17057bd6943260f1804ed554ce607660bb57b13bf59bcc92ddceb53ef39371', 'iman.avazpour@deakin.edu.au', 'iman', 'a', '2019-01-09', '2019-01-16', '', 1, 100, 0, 0),
(44, 'dpa76', '511577e6574f69dbd74c987c29c86ffe0495b73b2a85b7eb9200a19393bda5d3', 'danielpmarshall@gmail.com', 'Daniel', 'Marshall', '2019-01-09', '2019-02-03', '', 1, 100, 0, 0),
(52, 'mandr', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'mandr@deakin.edu.au', 'Andrew', 'Mitchell', '2019-01-15', '2019-02-03', '79d2b316f7789f25efa319b7028ff3e1bfa9b85af99a730438edc1fdc22c4751', 1, 100, 0, 0),
(53, 'killersoft', '796af12ebfb00b6564a928b847c283d5a346a28aeb37d2fa2e7856c1f21e22c4', 'gmclenna@deakin.edu.au', 'Greg', 'Mc', '2019-01-15', '2019-01-19', '', 1, 100, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catagory`
--
ALTER TABLE `catagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_func`
--
ALTER TABLE `cat_func`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clinical_program`
--
ALTER TABLE `clinical_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dependancy_rating`
--
ALTER TABLE `dependancy_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `impact_reference`
--
ALTER TABLE `impact_reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mtdp`
--
ALTER TABLE `mtdp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_register`
--
ALTER TABLE `system_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `catagory`
--
ALTER TABLE `catagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cat_func`
--
ALTER TABLE `cat_func`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `clinical_program`
--
ALTER TABLE `clinical_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT for table `dependancy_rating`
--
ALTER TABLE `dependancy_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `impact_reference`
--
ALTER TABLE `impact_reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `mtdp`
--
ALTER TABLE `mtdp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `system_register`
--
ALTER TABLE `system_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
