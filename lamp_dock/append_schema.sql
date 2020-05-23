SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

-- 
-- テーブルの構造 `history`
-- 

CREATE TABLE 'history' (
    'order_id' int(11) NOT NULL,
    'user_id' int(11) NOT NULL,
    'item_id' int(11) NOT NULL,
    'cart_id' int(11) NOT NULL,
    'created' datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


--
-- テーブルの構造 `details`
--

CREATE TABLE 'details' (
    'detail_id' int(11) NOT NULL,    
    'order_id' int(11) NOT NULL,
    'created' datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`order_id`);

--
-- テーブルのインデックス `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `history`
--
ALTER TABLE `history`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `details`
--
ALTER TABLE `details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`detail_id`) REFERENCES `details` (`detail_id`);
--
-- テーブルの制約 `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `history` (`order_id`);
  ADD CONSTRAINT `details_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `details_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `details_ibfk_4` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE;
COMMIT;