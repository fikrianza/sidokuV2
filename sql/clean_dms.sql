--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.1
-- Dumped by pg_dump version 9.6.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION adminpack; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: antrian_surat_per_tahun; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE antrian_surat_per_tahun (
    id_antrian integer NOT NULL,
    nomor_surat_terakhir integer,
    created_date integer
);


ALTER TABLE antrian_surat_per_tahun OWNER TO postgres;

--
-- Name: antrian_surat_per_tahun_id_antrian_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE antrian_surat_per_tahun_id_antrian_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE antrian_surat_per_tahun_id_antrian_seq OWNER TO postgres;

--
-- Name: antrian_surat_per_tahun_id_antrian_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE antrian_surat_per_tahun_id_antrian_seq OWNED BY antrian_surat_per_tahun.id_antrian;


--
-- Name: arvin; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE arvin
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arvin OWNER TO postgres;

--
-- Name: master_jenis_surat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE master_jenis_surat (
    id_jenis_surat integer NOT NULL,
    nama_jenis_surat character varying(50) NOT NULL,
    created_by integer NOT NULL,
    created_date timestamp without time zone DEFAULT (now())::timestamp(0) without time zone NOT NULL,
    update_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL
);


ALTER TABLE master_jenis_surat OWNER TO postgres;

--
-- Name: master_jenis_surat_id_jenis_surat_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE master_jenis_surat_id_jenis_surat_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE master_jenis_surat_id_jenis_surat_seq OWNER TO postgres;

--
-- Name: master_jenis_surat_id_jenis_surat_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE master_jenis_surat_id_jenis_surat_seq OWNED BY master_jenis_surat.id_jenis_surat;


--
-- Name: master_keaslian_surat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE master_keaslian_surat (
    id_keaslian_surat integer NOT NULL,
    nama_keaslian_surat character varying(25) NOT NULL
);


ALTER TABLE master_keaslian_surat OWNER TO postgres;

--
-- Name: master_keaslian_surat_id_keaslian_surat_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE master_keaslian_surat_id_keaslian_surat_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE master_keaslian_surat_id_keaslian_surat_seq OWNER TO postgres;

--
-- Name: master_keaslian_surat_id_keaslian_surat_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE master_keaslian_surat_id_keaslian_surat_seq OWNED BY master_keaslian_surat.id_keaslian_surat;


--
-- Name: master_role; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE master_role (
    id_role integer NOT NULL,
    level integer NOT NULL,
    nama_role character varying(50) NOT NULL,
    created_by integer NOT NULL,
    created_date timestamp without time zone DEFAULT (now())::timestamp(0) without time zone NOT NULL,
    update_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL
);


ALTER TABLE master_role OWNER TO postgres;

--
-- Name: master_role_id_role_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE master_role_id_role_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE master_role_id_role_seq OWNER TO postgres;

--
-- Name: master_role_id_role_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE master_role_id_role_seq OWNED BY master_role.id_role;


--
-- Name: master_status_keuangan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE master_status_keuangan (
    id_status_keuangan integer NOT NULL,
    nama_status_keuangan character varying(25) NOT NULL
);


ALTER TABLE master_status_keuangan OWNER TO postgres;

--
-- Name: master_status_keuangan_id_status_keuangan_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE master_status_keuangan_id_status_keuangan_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE master_status_keuangan_id_status_keuangan_seq OWNER TO postgres;

--
-- Name: master_status_keuangan_id_status_keuangan_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE master_status_keuangan_id_status_keuangan_seq OWNED BY master_status_keuangan.id_status_keuangan;


--
-- Name: master_surat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE master_surat (
    id_surat integer NOT NULL,
    id_jenis_surat integer NOT NULL,
    id_keaslian_surat integer NOT NULL,
    no_urut_surat integer NOT NULL,
    perihal_surat character varying(200) NOT NULL,
    jumlah_lampiran integer NOT NULL,
    asal_surat character varying(200) NOT NULL,
    tujuan_surat character varying(200) NOT NULL,
    kode_surat character varying(25) NOT NULL,
    tanggal_pembuatan_surat date NOT NULL,
    tanggal_terima_surat date NOT NULL,
    deskripsi_surat text NOT NULL,
    status boolean NOT NULL,
    created_by integer NOT NULL,
    created_date timestamp without time zone DEFAULT (now())::timestamp(0) without time zone NOT NULL,
    update_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL
);


ALTER TABLE master_surat OWNER TO postgres;

--
-- Name: master_surat_id_surat_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE master_surat_id_surat_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE master_surat_id_surat_seq OWNER TO postgres;

--
-- Name: master_surat_id_surat_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE master_surat_id_surat_seq OWNED BY master_surat.id_surat;


--
-- Name: master_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE master_user (
    id_user integer NOT NULL,
    id_role integer NOT NULL,
    nama character varying(50) NOT NULL,
    username character varying(50) NOT NULL,
    password character varying(50) NOT NULL,
    nip character varying(20) NOT NULL,
    email character varying(50) NOT NULL,
    status boolean NOT NULL,
    is_deleted boolean NOT NULL,
    created_by integer NOT NULL,
    created_date timestamp without time zone DEFAULT (now())::timestamp(0) without time zone NOT NULL,
    update_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL
);


ALTER TABLE master_user OWNER TO postgres;

--
-- Name: master_user_id_user_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE master_user_id_user_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE master_user_id_user_seq OWNER TO postgres;

--
-- Name: master_user_id_user_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE master_user_id_user_seq OWNED BY master_user.id_user;


--
-- Name: relasi_disposisi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE relasi_disposisi (
    id_disposisi integer NOT NULL,
    id_user_pengirim integer NOT NULL,
    id_user_penerima integer NOT NULL,
    id_status_keuangan integer NOT NULL,
    id_surat integer NOT NULL,
    deskripsi text NOT NULL,
    is_approve boolean NOT NULL,
    is_read boolean NOT NULL,
    nominal_uang integer,
    deskripsi_keuangan text,
    created_by integer NOT NULL,
    created_date timestamp without time zone DEFAULT (now())::timestamp(0) without time zone NOT NULL,
    update_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL
);


ALTER TABLE relasi_disposisi OWNER TO postgres;

--
-- Name: relasi_disposisi_id_disposisi_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE relasi_disposisi_id_disposisi_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE relasi_disposisi_id_disposisi_seq OWNER TO postgres;

--
-- Name: relasi_disposisi_id_disposisi_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE relasi_disposisi_id_disposisi_seq OWNED BY relasi_disposisi.id_disposisi;


--
-- Name: sek; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sek
    START WITH 9
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sek OWNER TO postgres;

--
-- Name: antrian_surat_per_tahun id_antrian; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY antrian_surat_per_tahun ALTER COLUMN id_antrian SET DEFAULT nextval('antrian_surat_per_tahun_id_antrian_seq'::regclass);


--
-- Name: master_jenis_surat id_jenis_surat; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_jenis_surat ALTER COLUMN id_jenis_surat SET DEFAULT nextval('master_jenis_surat_id_jenis_surat_seq'::regclass);


--
-- Name: master_keaslian_surat id_keaslian_surat; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_keaslian_surat ALTER COLUMN id_keaslian_surat SET DEFAULT nextval('master_keaslian_surat_id_keaslian_surat_seq'::regclass);


--
-- Name: master_role id_role; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_role ALTER COLUMN id_role SET DEFAULT nextval('master_role_id_role_seq'::regclass);


--
-- Name: master_status_keuangan id_status_keuangan; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_status_keuangan ALTER COLUMN id_status_keuangan SET DEFAULT nextval('master_status_keuangan_id_status_keuangan_seq'::regclass);


--
-- Name: master_surat id_surat; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_surat ALTER COLUMN id_surat SET DEFAULT nextval('master_surat_id_surat_seq'::regclass);


--
-- Name: master_user id_user; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_user ALTER COLUMN id_user SET DEFAULT nextval('master_user_id_user_seq'::regclass);


--
-- Name: relasi_disposisi id_disposisi; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY relasi_disposisi ALTER COLUMN id_disposisi SET DEFAULT nextval('relasi_disposisi_id_disposisi_seq'::regclass);


--
-- Data for Name: antrian_surat_per_tahun; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY antrian_surat_per_tahun (id_antrian, nomor_surat_terakhir, created_date) FROM stdin;
\.


--
-- Name: antrian_surat_per_tahun_id_antrian_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('antrian_surat_per_tahun_id_antrian_seq', 1, false);


--
-- Name: arvin; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('arvin', 1, false);


--
-- Data for Name: master_jenis_surat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY master_jenis_surat (id_jenis_surat, nama_jenis_surat, created_by, created_date, update_by, update_date) FROM stdin;
\.


--
-- Name: master_jenis_surat_id_jenis_surat_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('master_jenis_surat_id_jenis_surat_seq', 1, false);


--
-- Data for Name: master_keaslian_surat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY master_keaslian_surat (id_keaslian_surat, nama_keaslian_surat) FROM stdin;
\.


--
-- Name: master_keaslian_surat_id_keaslian_surat_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('master_keaslian_surat_id_keaslian_surat_seq', 1, false);


--
-- Data for Name: master_role; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY master_role (id_role, level, nama_role, created_by, created_date, update_by, update_date) FROM stdin;
\.


--
-- Name: master_role_id_role_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('master_role_id_role_seq', 1, false);


--
-- Data for Name: master_status_keuangan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY master_status_keuangan (id_status_keuangan, nama_status_keuangan) FROM stdin;
\.


--
-- Name: master_status_keuangan_id_status_keuangan_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('master_status_keuangan_id_status_keuangan_seq', 1, false);


--
-- Data for Name: master_surat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY master_surat (id_surat, id_jenis_surat, id_keaslian_surat, no_urut_surat, perihal_surat, jumlah_lampiran, asal_surat, tujuan_surat, kode_surat, tanggal_pembuatan_surat, tanggal_terima_surat, deskripsi_surat, status, created_by, created_date, update_by, update_date) FROM stdin;
\.


--
-- Name: master_surat_id_surat_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('master_surat_id_surat_seq', 1, false);


--
-- Data for Name: master_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY master_user (id_user, id_role, nama, username, password, nip, email, status, is_deleted, created_by, created_date, update_by, update_date) FROM stdin;
\.


--
-- Name: master_user_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('master_user_id_user_seq', 1, false);


--
-- Data for Name: relasi_disposisi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY relasi_disposisi (id_disposisi, id_user_pengirim, id_user_penerima, id_status_keuangan, id_surat, deskripsi, is_approve, is_read, nominal_uang, deskripsi_keuangan, created_by, created_date, update_by, update_date) FROM stdin;
\.


--
-- Name: relasi_disposisi_id_disposisi_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('relasi_disposisi_id_disposisi_seq', 1, false);


--
-- Name: sek; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sek', 11, true);


--
-- Name: antrian_surat_per_tahun antrian_surat_per_tahun_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY antrian_surat_per_tahun
    ADD CONSTRAINT antrian_surat_per_tahun_pkey PRIMARY KEY (id_antrian);


--
-- Name: master_jenis_surat master_jenis_surat_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_jenis_surat
    ADD CONSTRAINT master_jenis_surat_pkey PRIMARY KEY (id_jenis_surat);


--
-- Name: master_keaslian_surat master_keaslian_surat_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_keaslian_surat
    ADD CONSTRAINT master_keaslian_surat_pkey PRIMARY KEY (id_keaslian_surat);


--
-- Name: master_role master_role_nama_role_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_role
    ADD CONSTRAINT master_role_nama_role_key UNIQUE (nama_role);


--
-- Name: master_role master_role_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_role
    ADD CONSTRAINT master_role_pkey PRIMARY KEY (id_role);


--
-- Name: master_status_keuangan master_status_keuangan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_status_keuangan
    ADD CONSTRAINT master_status_keuangan_pkey PRIMARY KEY (id_status_keuangan);


--
-- Name: master_surat master_surat_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_surat
    ADD CONSTRAINT master_surat_pkey PRIMARY KEY (id_surat);


--
-- Name: master_user master_user_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_user
    ADD CONSTRAINT master_user_email_key UNIQUE (email);


--
-- Name: master_user master_user_nip_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_user
    ADD CONSTRAINT master_user_nip_key UNIQUE (nip);


--
-- Name: master_user master_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_user
    ADD CONSTRAINT master_user_pkey PRIMARY KEY (id_user);


--
-- Name: master_user master_user_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_user
    ADD CONSTRAINT master_user_username_key UNIQUE (username);


--
-- Name: relasi_disposisi relasi_disposisi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY relasi_disposisi
    ADD CONSTRAINT relasi_disposisi_pkey PRIMARY KEY (id_disposisi);


--
-- Name: master_surat master_surat_id_jenis_surat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_surat
    ADD CONSTRAINT master_surat_id_jenis_surat_fkey FOREIGN KEY (id_jenis_surat) REFERENCES master_jenis_surat(id_jenis_surat) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: master_surat master_surat_id_keaslian_surat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_surat
    ADD CONSTRAINT master_surat_id_keaslian_surat_fkey FOREIGN KEY (id_keaslian_surat) REFERENCES master_keaslian_surat(id_keaslian_surat) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: master_user master_user_id_role_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY master_user
    ADD CONSTRAINT master_user_id_role_fkey FOREIGN KEY (id_role) REFERENCES master_role(id_role) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: relasi_disposisi relasi_disposisi_id_status_keuangan_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY relasi_disposisi
    ADD CONSTRAINT relasi_disposisi_id_status_keuangan_fkey FOREIGN KEY (id_status_keuangan) REFERENCES master_status_keuangan(id_status_keuangan) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: relasi_disposisi relasi_disposisi_id_surat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY relasi_disposisi
    ADD CONSTRAINT relasi_disposisi_id_surat_fkey FOREIGN KEY (id_surat) REFERENCES master_surat(id_surat) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

