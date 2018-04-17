-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 17, 2018 at 01:19 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_tracks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `id_user`, `id_tracks`) VALUES
(1, 1, '{\'1:2:3\'}');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`, `description`) VALUES
(1, 'Hoài Lâm', 'Hoài Lâm có tên khai sinh là Nguyễn Tuấn Lộc, sinh ngày 01/7/1995 tại xã Tân Lược, huyện Bình Tân, tỉnh Vĩnh Long, miền Tây Nam Bộ, Việt Nam.\n\nHoài Lâm là con một, được sinh ra trong một gia đình có truyền thống nghệ thuật. Bố của Hoài Lâm là một nghệ sĩ cải lương, từng có thời gian hoạt động nghệ thuật cùng Nghệ sĩ ưu tú Cẩm Tiên, một trong những nghệ sĩ cải lương nổi tiếng tại TP Hồ Chí Minh. Bố đẻ của Hoài Lâm tên là Nguyễn Văn Mỡ, mẹ của Hoài Lâm tên là Thái Thanh Loan [1]. Hai ông bà tham gia quản lý một đoàn nghệ thuật cải lương tại tỉnh Vĩnh Long, chuyên tổ chức các buổi biểu diễn cải lương tại các hội chợ ở Vĩnh Long.'),
(2, 'Đan Nguyên', 'Đan Nguyên sinh ngày 9 tháng 7 năm 1984 tại thị trấn Phú Lộc, Phú Lộc, Thừa Thiên Huế. Năm 1998, anh cùng mẹ và hai em gái, một em trai sang định cư ở Hoa Kỳ theo diện Rover.[2] Nơi định cư đầu tiên của Ðan Nguyên là Quận Cam, Nam California. Họ Nguyễn tên Đan, nên anh đã lấy nghệ danh là Đan Nguyên, tên gọi thân mật là “Đan”. Hiện nay, Đan Nguyên thường xuyên góp mặt trong các chương trình ca nhạc của người Việt ở hải ngoại, cũng như lưu diễn ở Anh, Canada và Úc....');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`, `description`) VALUES
(1, 'Nhạc Bolero', ''),
(2, 'Nhạc Vàng', '');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) NOT NULL,
  `role` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role`, `description`) VALUES
(1, 'super admin', 'tài khoản cấp cao. Toàn quyền truy cập website'),
(2, 'admin', 'quyền thêm sửa xóa bài hát và users'),
(3, 'user gold', 'xem nghe và dowload các bài hát, tạo album'),
(4, 'user normal', 'xem nghe các bài hát có trên hệ thống');

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `id` int(10) UNSIGNED NOT NULL,
  `genres_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `lyric` text NOT NULL,
  `artist` int(10) UNSIGNED NOT NULL,
  `view` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `genres_id`, `name`, `lyric`, `artist`, `view`, `location`) VALUES
(1, 1, 'Đổi thay', 'Hãy thắp ánh sáng trong hồn tôi khi ưu tư đang chất đầy, \r\nvì tình em đổi thay. \r\nbao nhiêu mơ ước đang tan dần, \r\ncuộc tinh đã mất, thật xót xa \r\ntôi như chơi vơi trong biển khơi \r\nsao em ra đi ko quay về \r\nđể lòng tôi nát tan \r\ncon tim khô héo trong mỏi mòn nhạc điệu ân ái nay còn đâu\r\n\r\nthật đớn đau trái ngang lòng tôi mang \r\ncùng cội đá, tôi chết giữa ngàn khơi \r\ngiọt đắng cay, thấm tan vào không gian \r\nhồn ta vỡ trắng tan đời ngả nghiêng\r\n\r\nkhi tôi trao em linh hồn tôi\r\nnhư ngôi sao băng qua đêm dài về nơi rất xa \r\ntôi đâu biết đang bay về một hành tinh sáng đầy dối gian \r\ntôi đi lang thang mong tìm em \r\nôi cơn đau thương thân dã dời mà đường ko nối đi \r\nnàng là giấc mơ kiêu kỳ để hồn tôi uống men rượu cay', 1, 63, 'Doi Thay - Hoai Lam.mp3'),
(2, 1, 'Cô bé ngày xưa', 'Hôm nay về thăm nhà, nhịp chân lối quen xưa, \r\nĐây vẫn cây cầu đá, kia mấy bụi tre già \r\nSang ngang một con đò bồng bềnh con nước đưa \r\nSương trắng phủ xa mờ, vài cánh én lưa thưa \r\n\r\nTrên con đường thăm nhà gặp cô gái đi qua \r\nDa trắng như màu áo, môi hé nụ hoa chào \r\nNhư quen mà xa lạ, bồi hồi chợt nhớ ra \r\nCô bé ngày xưa đó chung ngõ ở xóm nhà \r\n\r\nCô bé cô bé ở gần nhà ngăn cách khu vườn thưa lá \r\nGiờ xinh dáng hoa \r\nBé xưa vội oà ưa dỗi khóc,thường hai đứa một tâm hồn ít vui hơn buồn \r\nHôm nay về thăm nhà, tình hai đứa thêu hoa \r\nAnh nhắc câu chuyện cũ \r\nEm nói niềm mong chờ \r\nSay mơ một khung trời, mẹ hỏi đi nữa thôi, \r\nThưa với mẹ con sẽ, ở nhà đến suốt đời.', 1, 35, '1492781267-CoBeNgayXua-HoaiLam.mp3'),
(3, 1, 'Lời tỏ tình dễ thương', '', 1, 3, '1492782726-Loi-To-Tinh-De-Thuong--Hoai-Lam.mp3'),
(4, 1, 'Một mai giã từ', '', 2, 6, '1492785715-Mot-Mai-Gia-Tu-Vu-Khi--Quoc-Khanh-Dan-Nguyen.mp3'),
(5, 2, 'Phố Buồn', 'Đường về đêm đêm mưa rơi ướt bước chân em \r\nBùn lầy không quên bôi thêm lối ngõ không tên \r\nQua mấy gian không đèn \r\nNhững mái tranh im lìm \r\nĐường về nhà em tối đen. \r\nNhìn vào khe song trông anh ốm yếu ho hen \r\nMột ngày công lao không cho biết đến hương đêm \r\nEm bước chân qua thềm \r\nMưa vẫn rơi êm đềm \r\nVà chỉ làm phố buồn thêm. \r\nHạt mưa, mưa rơi tí tách \r\nMưa tuôn dưới vách \r\nMưa xuyên qua mành \r\nHạt mưa, mưa qua mái rách \r\nMưa như muốn trách \r\nSao ta chạy quanh. \r\nHạt mưa, mưa yêu áo rách \r\nYêu đôi sát nách \r\nMưa ngưng không đành \r\nHạt mưa, mưa gieo tí tách \r\nMưa lên tiếng hát \r\nRu cơn mộng lành. \r\nĐường về trong mơ đêm đêm phố lớn thênh thang \r\nÁnh sáng kinh kỳ tràn lan \r\nĐời nghèo không riêng thương yêu bóng dáng Xuân sang \r\nYêu phố vui, nhà gạch ngon \r\nĐèn đêm không soi bóng vắng \r\nKinh đô thắc mắc \r\nIm nghe phố buồn \r\nNgười đi trong đêm tối ám \r\nNghe mưa thức giấc \r\nKhuyên nhau chờ mong.', 1, 1, '1492841620-PhoBuon-HoaiLam.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `id_facebook` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `display_name`, `password`, `email`, `role_id`, `avatar`, `id_facebook`) VALUES
(1, 'admin', 'super admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@gmail.com', 1, 'avatar.jpg', '11111222222');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
