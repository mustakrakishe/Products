INSERT INTO product
    (name, description, price)
VALUES
    ('Bread', 'Fresh weat bread', 10),
    ('Wine', 'Bordeaux Red Blends from Napa Valley, California', 50);

INSERT INTO country
    (name)
VALUES
    ('England'),
    ('France');

INSERT INTO locale
    (name, iso, country_id)
VALUES
    ('English', 'en', 1),
    ('French', 'fr', 2);

INSERT INTO vat
    (country_id, product_id, value)
VALUES
    (1, 1, 7), 
    (1, 2, 15),
    (2, 1, 5),
    (2, 2, 12);
    