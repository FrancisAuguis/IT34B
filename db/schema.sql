CREATE TABLE IF NOT EXISTS activity_logs(
    activitty_log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(50),
    user_email VARCHAR(50),
    activity_log_id_action VARACHAR(50) NOT NULL,
    activity_log_status ENUM ('success' , 'failed') DEFAULT 'success',

    -- client parameter
    activitty_log_id_address VARCHAR(45),
    activity_log_user_agent VARCHAR(255),

    --Timestamp
    activity_log_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);