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
    'created' datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


--
-- テーブルの構造 `details`
--

CREATE TABLE 'details' (
    'order_id' int(11) NOT NULL,
    'item_id' int(11) NOT NULL,
    'price' int(11) NOT NULL, -- 価格変更機能を持たせるため
    'amount' int(11) NOT NULL,
    'created' datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `details`
--
ALTER TABLE `details`
  ADD KEY `item_id` (`item_id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `history`
--
ALTER TABLE `history`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- テーブルの制約 `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `details_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE;
COMMIT;