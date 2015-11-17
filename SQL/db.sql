-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 18, 2015 at 02:45 AM
-- Server version: 10.0.21-MariaDB-1~vivid-log
-- PHP Version: 5.6.14-1+deb.sury.org~vivid+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `KLP-Firewall`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `idx` int(11) NOT NULL,
  `id` text NOT NULL,
  `pw` text NOT NULL,
  `name` text NOT NULL,
  `position` text NOT NULL,
  `profileimg` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `alarm`
--

CREATE TABLE `alarm` (
  `idx` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT '0 : 알람명, 1: SMS , 2: Email',
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `backup_packets`
--

CREATE TABLE `backup_packets` (
  `idx` int(11) NOT NULL DEFAULT '0',
  `source_ip` bigint(20) NOT NULL,
  `source_port` text NOT NULL,
  `destination_ip` bigint(20) NOT NULL,
  `destination_port` text NOT NULL,
  `tcpudp` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 : TCP, 1: UDP',
  `packet_count` int(11) NOT NULL,
  `totalbytes` int(11) NOT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `danger` int(11) NOT NULL DEFAULT '0' COMMENT 'danger 패킷 횟수',
  `warn` int(11) NOT NULL DEFAULT '0' COMMENT 'warn 패킷 횟수'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `GeoIP`
--

CREATE TABLE `GeoIP` (
  `idx` int(11) NOT NULL,
  `from_ip_int` int(11) NOT NULL,
  `to_ip_int` int(11) NOT NULL,
  `country_code` text NOT NULL,
  `country` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `GeoIP_Blacklist`
--

CREATE TABLE `GeoIP_Blacklist` (
  `idx` int(11) NOT NULL,
  `country_code` text NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `GeoIP_Traffic`
--

CREATE TABLE `GeoIP_Traffic` (
  `idx` int(11) NOT NULL,
  `country_code` text NOT NULL,
  `country` text NOT NULL,
  `totalbytes` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `IP_Blacklist`
--

CREATE TABLE `IP_Blacklist` (
  `idx` int(11) NOT NULL,
  `ip` text NOT NULL,
  `port` varchar(5) NOT NULL DEFAULT 'any',
  `protocol` varchar(6) NOT NULL DEFAULT 'any',
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `idx` int(11) NOT NULL,
  `admin_idx` int(11) NOT NULL,
  `action` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `packets`
--

CREATE TABLE `packets` (
  `idx` int(11) NOT NULL,
  `source_ip` bigint(20) NOT NULL,
  `source_port` int(11) NOT NULL,
  `destination_ip` bigint(20) NOT NULL,
  `destination_port` int(11) NOT NULL,
  `tcpudp` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 : TCP, 1: UDP',
  `packet_count` int(11) NOT NULL,
  `totalbytes` int(11) NOT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `danger` int(11) NOT NULL DEFAULT '0' COMMENT 'danger 패킷 횟수',
  `warn` int(11) NOT NULL DEFAULT '0' COMMENT 'warn 패킷 횟수'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `packet_log`
--

CREATE TABLE `packet_log` (
  `idx` int(11) NOT NULL,
  `source_ip` bigint(20) NOT NULL,
  `source_port` int(11) NOT NULL,
  `destination_ip` bigint(20) NOT NULL,
  `destination_port` int(11) NOT NULL,
  `tcpudp` tinyint(1) NOT NULL,
  `name` text NOT NULL,
  `hazard` tinyint(1) NOT NULL COMMENT '0 : warn , 1 : danger',
  `payload` text NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `protocol`
--

CREATE TABLE `protocol` (
  `idx` int(11) NOT NULL,
  `name` text NOT NULL,
  `port` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `idx` int(11) NOT NULL,
  `danger` tinyint(1) DEFAULT '0',
  `protocol` text NOT NULL,
  `source_ip` text NOT NULL,
  `source_port` text NOT NULL,
  `destination_ip` text NOT NULL,
  `destination_port` text NOT NULL,
  `msg` text NOT NULL,
  `flow` text NOT NULL,
  `content` text NOT NULL,
  `depth` text NOT NULL,
  `metadata` text NOT NULL,
  `classtype` text NOT NULL,
  `sid` text NOT NULL,
  `rev` text NOT NULL,
  `reference` text NOT NULL,
  `flowbits` text NOT NULL,
  `offset` text NOT NULL,
  `nocase` tinyint(1) DEFAULT '0',
  `distance` text NOT NULL,
  `pcre` text NOT NULL,
  `flags` text NOT NULL,
  `icmp_id` text NOT NULL,
  `itype` text NOT NULL,
  `fast_pattern` text NOT NULL,
  `icmp_seq` text NOT NULL,
  `byte_test` text NOT NULL,
  `within` text NOT NULL,
  `isdataat` text NOT NULL,
  `fragbits` text NOT NULL,
  `ip_proto` text NOT NULL,
  `dsize` text NOT NULL,
  `icode` text NOT NULL,
  `id` text NOT NULL,
  `ttl` text NOT NULL,
  `file_data` tinyint(1) DEFAULT '0',
  `dce_iface` text NOT NULL,
  `dce_opnum` text NOT NULL,
  `dce_stub_data` tinyint(1) DEFAULT '0',
  `byte_jump` text NOT NULL,
  `ack` text NOT NULL,
  `seq` text NOT NULL,
  `rawbytes` tinyint(1) DEFAULT '0',
  `http_uri` tinyint(1) DEFAULT '0',
  `http_raw_uri` tinyint(1) DEFAULT '0',
  `http_header` tinyint(1) DEFAULT '0',
  `http_stat_code` tinyint(1) DEFAULT '0',
  `detection_filter` text NOT NULL,
  `urilen` text NOT NULL,
  `tag` text NOT NULL,
  `asn1` text NOT NULL,
  `http_cookie` tinyint(1) DEFAULT '0',
  `ssl_version` text NOT NULL,
  `ssl_state` text NOT NULL,
  `ftpbounce` tinyint(1) DEFAULT '0',
  `http_method` tinyint(1) DEFAULT '0',
  `http_client_body` tinyint(1) DEFAULT '0',
  `base64_decode` text NOT NULL,
  `base64_data` tinyint(1) DEFAULT '0',
  `pkt_data` tinyint(1) DEFAULT '0',
  `sip_method` text NOT NULL,
  `sip_stat_code` text NOT NULL,
  `sip_header` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rules_data`
--

CREATE TABLE `rules_data` (
  `idx` int(11) NOT NULL,
  `data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `hazzard` int(1) NOT NULL,
  `bandwidth_from_ip` text NOT NULL,
  `bandwidth_to_ip` text NOT NULL,
  `save_packet` int(11) NOT NULL,
  `remove_packet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idx` int(11) NOT NULL,
  `ip` bigint(20) NOT NULL,
  `createdAt` datetime NOT NULL,
  `connectedAt` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 : 정상, 1: 차단'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`idx`),
  ADD KEY `idx` (`idx`);

--
-- Indexes for table `alarm`
--
ALTER TABLE `alarm`
  ADD PRIMARY KEY (`idx`),
  ADD KEY `idx` (`idx`);

--
-- Indexes for table `backup_packets`
--
ALTER TABLE `backup_packets`
  ADD KEY `destination_ip` (`destination_ip`),
  ADD KEY `source_ip` (`source_ip`);

--
-- Indexes for table `GeoIP`
--
ALTER TABLE `GeoIP`
  ADD PRIMARY KEY (`idx`),
  ADD KEY `from_ip_int` (`from_ip_int`),
  ADD KEY `to_ip_int` (`to_ip_int`);

--
-- Indexes for table `GeoIP_Blacklist`
--
ALTER TABLE `GeoIP_Blacklist`
  ADD PRIMARY KEY (`idx`),
  ADD KEY `idx` (`idx`);

--
-- Indexes for table `GeoIP_Traffic`
--
ALTER TABLE `GeoIP_Traffic`
  ADD PRIMARY KEY (`idx`);

--
-- Indexes for table `IP_Blacklist`
--
ALTER TABLE `IP_Blacklist`
  ADD PRIMARY KEY (`idx`),
  ADD KEY `idx` (`idx`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`idx`),
  ADD KEY `idx` (`idx`);

--
-- Indexes for table `packets`
--
ALTER TABLE `packets`
  ADD PRIMARY KEY (`idx`),
  ADD KEY `destination_ip` (`destination_ip`),
  ADD KEY `source_ip` (`source_ip`);

--
-- Indexes for table `packet_log`
--
ALTER TABLE `packet_log`
  ADD PRIMARY KEY (`idx`),
  ADD KEY `idx` (`idx`);

--
-- Indexes for table `protocol`
--
ALTER TABLE `protocol`
  ADD PRIMARY KEY (`idx`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`idx`);

--
-- Indexes for table `rules_data`
--
ALTER TABLE `rules_data`
  ADD PRIMARY KEY (`idx`),
  ADD KEY `idx` (`idx`),
  ADD KEY `idx_2` (`idx`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idx`),
  ADD KEY `ip` (`ip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `alarm`
--
ALTER TABLE `alarm`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `GeoIP`
--
ALTER TABLE `GeoIP`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107566;
--
-- AUTO_INCREMENT for table `GeoIP_Blacklist`
--
ALTER TABLE `GeoIP_Blacklist`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `GeoIP_Traffic`
--
ALTER TABLE `GeoIP_Traffic`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT for table `IP_Blacklist`
--
ALTER TABLE `IP_Blacklist`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `packets`
--
ALTER TABLE `packets`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;
--
-- AUTO_INCREMENT for table `packet_log`
--
ALTER TABLE `packet_log`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `protocol`
--
ALTER TABLE `protocol`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rules_data`
--
ALTER TABLE `rules_data`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3325;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
