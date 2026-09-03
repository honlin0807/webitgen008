USE myneivceweb;

CREATE TABLE IF NOT EXISTS home_content (
    id INT PRIMARY KEY,
    announcement TEXT NOT NULL,
    introduction TEXT NOT NULL,
    ecommerce TEXT NOT NULL,
    programming TEXT NOT NULL,
    training TEXT NOT NULL
);

INSERT INTO home_content (id, announcement, introduction, ecommerce, programming, training)
SELECT
    1,
    (SELECT content_value FROM site_content WHERE content_key = 'announcement'),
    (SELECT content_value FROM site_content WHERE content_key = 'introduction'),
    (SELECT content_value FROM site_content WHERE content_key = 'service_ecommerce'),
    (SELECT content_value FROM site_content WHERE content_key = 'service_programming'),
    (SELECT content_value FROM site_content WHERE content_key = 'service_training')
WHERE NOT EXISTS (SELECT id FROM home_content WHERE id = 1);
