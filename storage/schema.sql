CREATE TABLE IF NOT EXISTS partecipants (
    _id TEXT PRIMARY KEY NOT NULL,
    active INTEGER(1) NOT NULL,
    audio_path TEXT,
    has_audio INTEGER(1) NOT NULL,
    image_path TEXT,
    has_image INTEGER(1) NOT NULL,
    name TEXT
);
