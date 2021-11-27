create schema web_database;
use web_database;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 27, 2021 lúc 06:20 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_database`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `infomation`
--

CREATE TABLE `infomation` (
  `infoId` int(11) NOT NULL,
  `title1` varchar(200) DEFAULT NULL,
  `content1` varchar(500) DEFAULT NULL,
  `image1` varchar(500) DEFAULT NULL,
  `title2` varchar(200) DEFAULT NULL,
  `content2` varchar(500) DEFAULT NULL,
  `image2` varchar(500) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` char(10) DEFAULT NULL,
  `facebook` varchar(200) DEFAULT NULL,
  `twitter` varchar(200) DEFAULT NULL,
  `instagram` varchar(200) DEFAULT NULL,
  `tiktok` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `infomation`
--

INSERT INTO `infomation` (`infoId`, `title1`, `content1`, `image1`, `title2`, `content2`, `image2`, `address`, `email`, `phone`, `facebook`, `twitter`, `instagram`, `tiktok`) VALUES
(4, 'ROOM PRO', 'We provide renting meeting rooms, halls and stages for your professional events.', 'https://firebasestorage.googleapis.com/v0/b/react-native-c15bd.appspot.com/o/DCT%20Trading%20Offices%20-%20Istanbul%20_%20Office%20Snapshots.jfif?alt=media&token=9c0ccbb3-3b96-4672-837a-4827566d384f', 'About us', 'Everything about customers are all what we are concerned. Therefore, lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas egesta.', 'https://firebasestorage.googleapis.com/v0/b/react-native-c15bd.appspot.com/o/Deco%20Shapes.jfif?alt=media&token=22e2899d-c45e-4346-8f46-898fe2872e16', 'Linh Trung, Thu Duc, Ho Chi Minh City', 'nhduc2001kt@gmail.com', '0935735723', 'https://www.facebook.com/profile.php?id=100009976037363', 'https://www.facebook.com/profile.php?id=100009976037363', 'https://www.facebook.com/profile.php?id=100009976037363', 'https://www.facebook.com/profile.php?id=100009976037363');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `newsId` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `createDate` date DEFAULT NULL,
  `modifyDate` date DEFAULT NULL,
  `content` varchar(2048) DEFAULT NULL,
  `image` varchar(1024) DEFAULT NULL,
  `public` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`newsId`, `title`, `createDate`, `modifyDate`, `content`, `image`, `public`) VALUES
(1, 'Classification of Omicron (B.1.1.529): SARS-CoV-2', '2021-11-27', '2021-11-27', 'The Technical Advisory Group on SARS-CoV-2 Virus Evolution (TAG-VE) is an independent group of experts that periodically monitors and evaluates the evolution of SARS-CoV-2 and assesses if specific mutations and combinations of mutations alter the behaviour of the virus. The TAG-VE was convened on 26 November 2021 to assess the SARS-CoV-2 variant: B.1.1.529.\n\nThe B.1.1.529 variant was first reported to WHO from South Africa on 24 November 2021. The epidemiological situation in South Africa has been characterized by three distinct peaks in reported cases, the latest of which was predominantly the Delta variant. In recent weeks, infections have increased steeply, coinciding with the detection of B.1.1.529 variant. The first known confirmed B.1.1.529 infection was from a specimen collected on 9 November 2021.\n\nThis variant has a large number of mutations, some of which are concerning. Preliminary evidence suggests an increased risk of reinfection with this variant, as compared to other VOCs. The number of cases of this variant appears to be increasing in almost all provinces in South Africa. Current SARS-CoV-2 PCR diagnostics continue to detect this variant. Several labs have indicated that for one widely used PCR test, one of the three target genes is not detected (called S gene dropout or S gene target failure) and this test can therefore be used as marker for this variant, pending sequencing confirmation. Using this approach, this variant has been detected at faster rates than previous surges in infection, suggesting that this variant may have a growth advantage.\n\nThere are a number of studies underway and the TAG-VE will continue to evaluate this variant. WHO will communicate new findings with Member States and to the public as needed.', 'https://ik.imagekit.io/hoangtrung070801/news_Sat_Nov_27_2021_20_21_21_GMT_0700__Gi%E1%BB%9D_%C4%90%C3%B4ng_D%C6%B0%C6%A1ng__YYF8Eaftm?ik-sdk-version=javascript-1.4.2', 0),
(2, 'Splay Trees (with implementations in C++, Java, and Python)', '2021-11-27', '2021-11-27', 'A Splay tree is a self-adjusting binary search tree invented by Sleator and Tarjan. Unlike an AVL tree (or a Red-Black tree), the structure of the splay tree changes even after the search operation. Every time we search an item x or insert x, it moves x to the root of the tree so that the next access of x is quick. The goal of the splay tree is not to make every operation fast rather make the sequence of operations fast. The individual operation in the splay tree can, sometimes, take O(n) time making the worst case running time linear. The sequence of operations, however, take O(logn) amortized time per operation. In other words, the sequence of M operations takes O(Mlogn) time. Since the splay tree adjusts itself according to usage, it performs much more efficiently than other binary search trees if the usage pattern is skewed.\n\nUnlike an AVL or a Red-Black tree where the tree must maintain their invariants all the time, the structure of the splay tree can be in any arbitrary state (although it should maintain the binary search tree invariants all the time) but during every operation, it restructures the tree to improve the efficiency of future (incoming) operations.\n\nThe splay tree moves a node x to the root of the tree by performing series of single and double tree rotations. Each double rotations moves x to its grandparent’s place and every single rotation moves x to its parent’s place. We perform these rotations until x reaches to the root of the tree. This process is called splaying. Besides moving x to the root, splaying also shortens the height of the tree which makes the tree more balanced. There are two types of single rotations and four types of double rotations. Each of them is explained in detail below.', 'https://ik.imagekit.io/hoangtrung070801/news_Sat_Nov_27_2021_20_24_10_GMT_0700__Gi%E1%BB%9D_%C4%90%C3%B4ng_D%C6%B0%C6%A1ng__9Lap2zuBu?ik-sdk-version=javascript-1.4.2', 0),
(3, 'Nữ sinh có điểm văn cao nhất nước đi bán bánh mỳ thuê', '2021-11-27', '2021-11-27', 'Nhưng trong ánh mắt của cô nữ sinh xứ Quảng vẫn còn đó nhiều nỗi băn khoăn, lo lắng cho những dự định, kế hoạch trong tương lai.\n\nKhác với nhiều bạn bè cùng trang lứa, sau kỳ thi thường nghỉ “xả hơi”, chuẩn bị hành trang để vào môi trường học mới thì Trâm đã vội vàng đón xe ra Đà Nẵng tìm việc làm thêm.\n\n“Kỳ thi vừa rồi môn Văn em đạt 9,5 điểm; Toán 7,6 điểm và Ngoại ngữ: 8,4 điểm. Nguyện vọng 1 của em là vào Trường Đại học Ngoại thương thành phố Hồ Chí Minh và nguyện vọng 2 là Đại học Kinh tế thành phố Hồ Chí Minh hoặc Đại học Kinh tế Đà Nẵng.\n\nVới hoàn cảnh kinh tế gia đình em hiện tại thì chi phí học tập những trường này là quá cao, rất khó khăn cho ba mẹ”, Trâm chia sẻ.', 'https://ik.imagekit.io/hoangtrung070801/news_Sat_Nov_27_2021_20_25_40_GMT_0700__Gi%E1%BB%9D_%C4%90%C3%B4ng_D%C6%B0%C6%A1ng__e12U7JekVX_?ik-sdk-version=javascript-1.4.2', 0),
(4, 'Rome Business School', '2021-11-27', '2021-11-27', 'The Rome Business School was founded in 2011 in Rome, Italy by Antonio Ragusa and its campus is located in Via Giuseppe Montanelli, 5, Rome. The school launched its activities by offering training and post-graduate Master courses in the field of marketing and other managerial competencies such as Human Resources.\n\nIn 2013, the school signed several partnerships with foreign institutes and universities such as the EAE Business School.\n\nSince 2019, Rome Business School is a member of Planeta Formación y Universidades, an international network created by De Agostini and the group Planeta.', 'https://ik.imagekit.io/hoangtrung070801/news_Sat_Nov_27_2021_20_27_18_GMT_0700__Gi%E1%BB%9D_%C4%90%C3%B4ng_D%C6%B0%C6%A1ng__CCDIbLj-K?ik-sdk-version=javascript-1.4.2', 0),
(5, 'Travel and tourism heats up causing hotel prices to rise', '2021-11-27', '2021-11-27', 'Hotel room rates nationally jumped 9% in April after an 8% rise in March, and airfares soared 10% in April, according to the latest available figures from the Commerce Department.\n\nIn Hawaii, Safe Stay protocols are still putting limited capacities on hotels, causing rooms to fill up faster. Those guidelines include social distancing on the property and 24-hour vacancies in between guests.\n\n“Typically, when you check into a hotel room, it’s minutes between the time that someone has left the room and, the room has been cleaned,” said Kekoa McClellan with the American Hotel and Lodging Association. “They’re checking in there. So for properties that are deploying that standard, it definitely impacts your ability to change a room over and then to book those rooms.”\n\nThe hotel industry is working with the Hawaii State Department of Health to see when those rules can be dropped.', 'https://ik.imagekit.io/hoangtrung070801/news_Sat_Nov_27_2021_20_28_44_GMT_0700__Gi%E1%BB%9D_%C4%90%C3%B4ng_D%C6%B0%C6%A1ng__eyk7GIQYvBH?ik-sdk-version=javascript-1.4.2', 0),
(6, 'WibuKey Troubleshooting Guide', '2021-11-27', '2021-11-27', 'ARCHICAD forgot the local Key, if I Wake up Mac Intel from sleep\nIn the System profiler window the key is visible. Reason: The local key is plugged in to a white color Mac keyboard, just like the mouse. Note: with the black color Mac keyboard the problem is not relevant. When starting the Program, in the WkConfig file only the local key is chosen.\nKeyplug is not found after waking the computer\nWhen ARCHICAD is running and the computer will put to sleep with power button and will wake up with the power button as well after trying to save from ARCHICAD the program message will come up: Wibu key can not be found. Workaround 1: The mouse should not be plugged in to the keyboard Workaround 2: The computer should be waked with the keyboard or with the mouse Workaround 3: Pull out the key and plug in again, ARCHICAD will run.', 'https://ik.imagekit.io/hoangtrung070801/news_Sat_Nov_27_2021_20_31_17_GMT_0700__Gi%E1%BB%9D_%C4%90%C3%B4ng_D%C6%B0%C6%A1ng__QuBxu0REv?ik-sdk-version=javascript-1.4.2', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news_comment`
--

CREATE TABLE `news_comment` (
  `commentId` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `content` varchar(200) DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `newsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `news_comment`
--

INSERT INTO `news_comment` (`commentId`, `date`, `content`, `userId`, `newsId`) VALUES
(1, '2021-11-27', 'Oh no, it would be hard.', 1, 1),
(2, '2021-11-27', 'Interesting fact.', 1, 3),
(3, '2021-11-27', 'Really??', 1, 6),
(4, '2021-11-27', 'Anyone tried?', 1, 4),
(5, '2021-11-27', 'Is it cabbage news? Meh', 2, 3),
(6, '2021-11-27', 'Not a fan, really?', 2, 2),
(7, '2021-11-27', 'Wibu team appear!', 2, 6),
(8, '2021-11-27', ':(', 3, 1),
(9, '2021-11-27', ':(', 3, 2),
(10, '2021-11-27', ':)', 3, 3),
(11, '2021-11-27', ':(', 3, 5),
(12, '2021-11-27', ':((((', 4, 1),
(13, '2021-11-27', 'Not yet', 4, 4),
(14, '2021-11-27', ':))', 4, 6),
(15, '2021-11-27', 'Nice', 5, 4),
(16, '2021-11-27', '...', 5, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reservation`
--

CREATE TABLE `reservation` (
  `resId` int(11) NOT NULL,
  `bookDate` date DEFAULT NULL,
  `useDate` date DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `totalPrice` int(11) DEFAULT NULL,
  `statusR` char(1) DEFAULT NULL,
  `roomId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `reservation`
--

INSERT INTO `reservation` (`resId`, `bookDate`, `useDate`, `startTime`, `endTime`, `totalPrice`, `statusR`, `roomId`, `userId`) VALUES
(1, '2021-11-27', '2021-11-27', '10:00:00', '11:00:00', 600, 'P', 1, 2),
(2, '2021-11-27', '2021-11-28', '19:30:00', '20:30:00', 1600, 'P', 3, 2),
(3, '2021-11-27', '2021-11-29', '17:30:00', '20:00:00', 400, 'P', 6, 2),
(4, '2021-11-27', '2021-11-30', '15:00:00', '17:00:00', 240, 'U', 9, 2),
(5, '2021-11-27', '2021-11-30', '18:00:00', '19:30:00', 2700, 'U', 13, 2),
(6, '2021-11-27', '2021-12-01', '12:00:00', '13:30:00', 300, 'U', 10, 2),
(7, '2021-11-27', '2021-11-29', '17:30:00', '19:00:00', 450, 'P', 8, 3),
(8, '2021-11-27', '2021-11-27', '12:00:00', '13:30:00', 900, 'P', 1, 3),
(9, '2021-11-27', '2021-12-01', '17:00:00', '19:00:00', 240, 'U', 9, 3),
(10, '2021-11-27', '2021-11-30', '10:00:00', '12:00:00', 600, 'U', 8, 4),
(11, '2021-11-27', '2021-12-01', '19:30:00', '21:00:00', 180, 'U', 9, 4),
(12, '2021-11-27', '2021-11-29', '14:00:00', '15:30:00', 1950, 'P', 14, 4),
(13, '2021-11-27', '2021-12-01', '10:30:00', '12:00:00', 1950, 'U', 14, 5),
(14, '2021-11-27', '2021-11-27', '18:30:00', '20:00:00', 300, 'P', 5, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room`
--

CREATE TABLE `room` (
  `roomId` int(11) NOT NULL,
  `roomName` varchar(100) DEFAULT NULL,
  `type` char(1) DEFAULT NULL,
  `floor` int(11) DEFAULT NULL,
  `seat` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `statusRo` char(1) DEFAULT NULL,
  `openTime` time DEFAULT NULL,
  `closeTime` time DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `image` varbinary(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `room`
--

INSERT INTO `room` (`roomId`, `roomName`, `type`, `floor`, `seat`, `price`, `statusRo`, `openTime`, `closeTime`, `address`, `description`, `image`) VALUES
(1, 'Hall 1', 'H', 0, 400, 300, 'A', '07:00:00', '16:00:00', '01 Vo Van Ngan, Linh Trung, Thu Duc, Ho Chi Minh', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mollis nunc sed id semper risus in. Felis donec et odio pellentesque diam vo', 0x68747470733a2f2f696b2e696d6167656b69742e696f2f686f616e677472756e673037303830312f30305f4337483234414844576c383f696b2d73646b2d76657273696f6e3d6a6176617363726970742d312e342e32),
(2, 'Hall 2', 'H', 1, 500, 500, 'A', '09:00:00', '20:30:00', '2 Ly Thuong Kiet, Ward 14, Dist 10, Ho Chi Minh', 'Adipiscing elit pellentesque habitant morbi tristique senectus et netus et. Mattis molestie a iaculis at erat. Morbi blandit cursus risus at ultrices mi tempus.', 0x68747470733a2f2f696b2e696d6167656b69742e696f2f686f616e677472756e673037303830312f30305f4c73334e4b616c56433f696b2d73646b2d76657273696f6e3d6a6176617363726970742d312e342e32),
(3, 'Hall 3', 'H', 6, 500, 800, 'A', '08:30:00', '22:00:00', '3 Su Van Hanh, Ward 12, Dist 5, Ho Chi Minh', 'Vel risus commodo viverra maecenas accumsan lacus vel facilisis. Dui id ornare arcu odio ut. Augue lacus viverra vitae congue eu.', 0x68747470733a2f2f696b2e696d6167656b69742e696f2f686f616e677472756e673037303830312f30305f4b6d714c2d53444e583f696b2d73646b2d76657273696f6e3d6a6176617363726970742d312e342e32),
(4, 'Hall 4', 'H', 2, 300, 250, 'A', '08:00:00', '16:30:00', '4 Xa Lo Ha Noi, Linh Trung, Thu Duc, Ho Chi Minh', 'In hac habitasse platea dictumst vestibulum rhoncus est. Sed nisi lacus sed viverra tellus in hac habitasse platea. Sollicitudin aliquam ultrices sagittis orci a scelerisque purus semper.', 0x68747470733a2f2f696b2e696d6167656b69742e696f2f686f616e677472756e673037303830312f48616c6c30305f323073765853526d433f696b2d73646b2d76657273696f6e3d6a6176617363726970742d312e342e32),
(5, 'Meeting 1', 'M', 0, 30, 100, 'A', '07:00:00', '21:00:00', '5 Ca Luon Mac Can, Ward 10, Dist 1, Ho Chi Minh', 'Vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt ornare. Morbi quis commodo odio aenean sed adipiscing diam donec. Mattis rhoncus urna neque viverra justo. Condimentum mattis pellen', 0x68747470733a2f2f696b2e696d6167656b69742e696f2f686f616e677472756e673037303830312f30305f5834494d56484534353f696b2d73646b2d76657273696f6e3d6a6176617363726970742d312e342e32),
(6, 'Meeting 2', 'M', 2, 40, 80, 'A', '06:00:00', '22:00:00', '6 Nam Dan, Ward 4, Dist 2, Ho Chi Minh', 'Nulla facilisi nullam vehicula ipsum a arcu. Dui faucibus in ornare quam viverra orci sagittis eu volutpat. Nunc non blandit massa enim nec. Non sodales neque sodales ut etiam sit amet nisl purus. Acc', 0x68747470733a2f2f696b2e696d6167656b69742e696f2f686f616e677472756e673037303830312f4d656574696e675f726f6f6d3234305f42324f5943353035423f696b2d73646b2d76657273696f6e3d6a6176617363726970742d312e342e32),
(7, 'Meeting 3', 'M', 4, 60, 120, 'A', '08:30:00', '17:00:00', '7 Nam Ky Khoi Nghia, Ward 12, Dist 3, Ho Chi Minh', 'Proin sagittis nisl rhoncus mattis. Dolor magna eget est lorem ipsum dolor sit amet consectetur. Sit amet consectetur adipiscing elit ut aliquam purus sit amet.', 0x68747470733a2f2f696b2e696d6167656b69742e696f2f686f616e677472756e673037303830312f30305f4346736637586435393f696b2d73646b2d76657273696f6e3d6a6176617363726970742d312e342e32),
(8, 'Meeting 4', 'M', 9, 70, 150, 'A', '06:00:00', '20:00:00', '8 Hai Ba Trung, Ward 1, Dist 7, Ho Chi Minh', 'Tempor orci eu lobortis elementum. Tellus in metus vulputate eu scelerisque. Amet aliquam id diam maecenas. Ultricies mi eget mauris pharetra et ultrices neque ornare. Consectetur adipiscing elit duis', 0x68747470733a2f2f696b2e696d6167656b69742e696f2f686f616e677472756e673037303830312f30305f577a4d6a51676c624358533f696b2d73646b2d76657273696f6e3d6a6176617363726970742d312e342e32),
(9, 'Meeting 5', 'M', 1, 20, 60, 'A', '06:00:00', '22:00:00', '9 Ta Quang Buu, Dong Hoa, Di An, Binh Duong', 'Convallis aenean et tortor at risus viverra adipiscing. Pharetra vel turpis nunc eget lorem. Non arcu risus quis varius quam quisque. Facilisis mauris sit amet massa.', 0x68747470733a2f2f696b2e696d6167656b69742e696f2f686f616e677472756e673037303830312f30305f4d32364c54614377713f696b2d73646b2d76657273696f6e3d6a6176617363726970742d312e342e32),
(10, 'Meeting 6', 'M', 4, 10, 100, 'A', '09:00:00', '14:00:00', '10 Ho Xuan Huong, Ward 12, Dist 12, Ho Chi Minh', 'Nunc id cursus metus aliquam eleifend mi in nulla. Tempus quam pellentesque nec nam aliquam sem. Risus ultricies tristique nulla aliquet enim tortor. Aenean et tortor at risus viverra. Nulla facilisi ', 0x68747470733a2f2f696b2e696d6167656b69742e696f2f686f616e677472756e673037303830312f30305f59463835554a4e43693f696b2d73646b2d76657273696f6e3d6a6176617363726970742d312e342e32),
(11, 'Meeting 7', 'M', 0, 35, 70, 'A', '08:00:00', '22:00:00', '11 Ho Thi Ky, Ward 3, Dist 3, Ho Chi Minh', 'Posuere lorem ipsum dolor sit amet consectetur. Elementum integer enim neque volutpat. Augue mauris augue neque gravida in fermentum. Lacus suspendisse faucibus interdum posuere lorem ipsum dolor.', 0x68747470733a2f2f696b2e696d6167656b69742e696f2f686f616e677472756e673037303830312f30305f694d682d44567a6c2d3f696b2d73646b2d76657273696f6e3d6a6176617363726970742d312e342e32),
(12, 'Stage 1', 'S', 0, 900, 800, 'A', '06:00:00', '22:00:00', '12 999 Doa Hoa Hong, Ao Tuong, Mo Mong, Binh Duong', 'Lectus sit amet est placerat in egestas. Diam vulputate ut pharetra sit amet aliquam id. Sed ullamcorper morbi tincidunt ornare massa eget egestas purus. Quam lacus suspendisse faucibus interdum posue', 0x68747470733a2f2f696b2e696d6167656b69742e696f2f686f616e677472756e673037303830312f537461676530305f33315475742d354a4d3f696b2d73646b2d76657273696f6e3d6a6176617363726970742d312e342e32),
(13, 'Stage 2', 'S', 0, 750, 900, 'A', '06:00:00', '22:00:00', '14 Phan Boi Chau, Linh Trung, Thu Duc, Ho Chi Minh', 'Egestas pretium aenean pharetra magna. Vel orci porta non pulvinar neque. Imperdiet proin fermentum leo vel orci porta. Mattis rhoncus urna neque viverra. Id cursus metus aliquam eleifend mi in nulla.', 0x68747470733a2f2f696b2e696d6167656b69742e696f2f686f616e677472756e673037303830312f30305f55686777667575382d3f696b2d73646b2d76657273696f6e3d6a6176617363726970742d312e342e32),
(14, 'Stage 3', 'S', 0, 400, 650, 'A', '10:30:00', '22:00:00', '15 Tran Khat Chan, Ward 3, Dist 2, Ho Chi Minh', 'Tortor condimentum lacinia quis vel eros donec. Tortor vitae purus faucibus ornare. Suspendisse sed nisi lacus sed viverra tellus in hac. Ac placerat vestibulum lectus mauris ultrices eros in cursus t', 0x68747470733a2f2f696b2e696d6167656b69742e696f2f686f616e677472756e673037303830312f5374616765303430305f62426f7377467738323f696b2d73646b2d76657273696f6e3d6a6176617363726970742d312e342e32);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_comment`
--

CREATE TABLE `room_comment` (
  `commentId` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `content` varchar(200) DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `roomId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `room_comment`
--

INSERT INTO `room_comment` (`commentId`, `date`, `content`, `userId`, `roomId`) VALUES
(1, '2021-11-27', 'Having breakfast in this room would be great.', 2, 1),
(2, '2021-11-27', 'Luxury', 2, 4),
(3, '2021-11-27', 'Feel like great', 2, 6),
(4, '2021-11-27', 'Consistant', 2, 5),
(5, '2021-11-27', 'Not a fan', 2, 6),
(6, '2021-11-27', 'Hello there', 2, 11),
(7, '2021-11-27', 'Great lights', 2, 13),
(8, '2021-11-27', 'Aggree :) Cumeo', 3, 1),
(9, '2021-11-27', ':)', 3, 2),
(10, '2021-11-27', 'Quite good', 3, 3),
(11, '2021-11-27', 'Too lightened', 3, 7),
(12, '2021-11-27', 'Professional', 3, 8),
(13, '2021-11-27', 'Not a fan', 3, 12),
(14, '2021-11-27', 'Really? :))', 4, 1),
(15, '2021-11-27', 'Minor idea', 4, 5),
(16, '2021-11-27', 'This wont do', 4, 10),
(17, '2021-11-27', 'Weird', 4, 13),
(18, '2021-11-27', '...', 5, 2),
(19, '2021-11-27', '...', 5, 4),
(20, '2021-11-27', '...', 5, 7),
(21, '2021-11-27', '...', 5, 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `timeline`
--

CREATE TABLE `timeline` (
  `timeframe` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `timeline`
--

INSERT INTO `timeline` (`timeframe`) VALUES
('06:00:00'),
('06:30:00'),
('07:00:00'),
('07:30:00'),
('08:00:00'),
('08:30:00'),
('09:00:00'),
('09:30:00'),
('10:00:00'),
('10:30:00'),
('11:00:00'),
('11:30:00'),
('12:00:00'),
('12:30:00'),
('13:00:00'),
('13:30:00'),
('14:00:00'),
('14:30:00'),
('15:00:00'),
('15:30:00'),
('16:00:00'),
('16:30:00'),
('17:00:00'),
('17:30:00'),
('18:00:00'),
('18:30:00'),
('19:00:00'),
('19:30:00'),
('20:00:00'),
('20:30:00'),
('21:00:00'),
('21:30:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `sex` char(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone` char(10) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `type` char(1) DEFAULT NULL,
  `avatar` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`userId`, `username`, `sex`, `birthday`, `phone`, `address`, `email`, `password`, `type`, `avatar`) VALUES
(1, 'thienhoang', 'M', '2001-08-07', '1111111111', 'Kon Tum', 'thienhoang@gmail.com', 'something', 'M', 'https://ik.imagekit.io/hoangtrung070801/user1_61ttm-s_g?ik-sdk-version=javascript-1.4.2'),
(2, 'hoangtrung', 'M', '2001-08-07', '1111111111', 'Kon Tum', 'hoangtrung@gmail.com', 'something', 'C', 'https://ik.imagekit.io/hoangtrung070801/user2_fp0Vr1bf0?ik-sdk-version=javascript-1.4.2'),
(3, 'xuannam', 'M', '2001-02-23', '1111111111', 'Hue', 'xuannam@gmail.com', 'something', 'C', 'https://ik.imagekit.io/hoangtrung070801/user3_IH6TsmJCu?ik-sdk-version=javascript-1.4.2'),
(4, 'huynhduc', 'M', '2001-06-13', '1111111111', 'Kon Tum', 'huynhduc@gmail.com', 'something', 'C', 'https://ik.imagekit.io/hoangtrung070801/user4_SKK_ygiPL?ik-sdk-version=javascript-1.4.2'),
(5, 'ngocthan', 'M', '2001-12-12', '1111111111', 'Binh Dinh', 'ngocthan@gmail.com', 'something', 'C', 'https://ik.imagekit.io/hoangtrung070801/user5_-1mCJ94hi?ik-sdk-version=javascript-1.4.2');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `infomation`
--
ALTER TABLE `infomation`
  ADD PRIMARY KEY (`infoId`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsId`);

--
-- Chỉ mục cho bảng `news_comment`
--
ALTER TABLE `news_comment`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `newsId` (`newsId`);

--
-- Chỉ mục cho bảng `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`resId`),
  ADD KEY `roomId` (`roomId`),
  ADD KEY `userId` (`userId`);

--
-- Chỉ mục cho bảng `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomId`);

--
-- Chỉ mục cho bảng `room_comment`
--
ALTER TABLE `room_comment`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `roomId` (`roomId`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `infomation`
--
ALTER TABLE `infomation`
  MODIFY `infoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `newsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `news_comment`
--
ALTER TABLE `news_comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `reservation`
--
ALTER TABLE `reservation`
  MODIFY `resId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `room`
--
ALTER TABLE `room`
  MODIFY `roomId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `room_comment`
--
ALTER TABLE `room_comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `news_comment`
--
ALTER TABLE `news_comment`
  ADD CONSTRAINT `news_comment_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_comment_ibfk_2` FOREIGN KEY (`newsId`) REFERENCES `news` (`newsId`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`roomId`) REFERENCES `room` (`roomId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `room_comment`
--
ALTER TABLE `room_comment`
  ADD CONSTRAINT `room_comment_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `room_comment_ibfk_2` FOREIGN KEY (`roomId`) REFERENCES `room` (`roomId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
