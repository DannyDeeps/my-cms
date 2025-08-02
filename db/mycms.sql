CREATE TABLE sites (id INTEGER PRIMARY KEY, name TEXT, domain TEXT, theme_id INTEGER, FOREIGN KEY(theme_id) REFERENCES themes(id));
CREATE TABLE page_kits (id INTEGER PRIMARY KEY, site_id INTEGER, name TEXT, FOREIGN KEY(site_id) REFERENCES sites(id));
CREATE TABLE themes (id INTEGER PRIMARY KEY, name TEXT);
