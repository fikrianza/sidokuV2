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
-- Name: postgres; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE postgres IS 'default administrative connection database';


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
2	4	2018
3	3	2019
4	3	2020
1	6	2017
\.


--
-- Name: antrian_surat_per_tahun_id_antrian_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('antrian_surat_per_tahun_id_antrian_seq', 4, true);


--
-- Name: arvin; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('arvin', 1, false);


--
-- Data for Name: master_jenis_surat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY master_jenis_surat (id_jenis_surat, nama_jenis_surat, created_by, created_date, update_by, update_date) FROM stdin;
1	Biasa	1	2017-12-05 06:32:04	1	2017-09-27 00:00:00
2	Rahasia	1	2017-12-05 06:32:04	1	2017-09-27 00:00:00
3	Penting	1	2017-12-05 06:32:04	1	2017-09-27 00:00:00
4	Sangat Penting	1	2017-12-05 06:32:04	1	2017-09-27 00:00:00
5	Sangat_Rahasia	1	2017-12-05 06:32:04	1	2017-09-27 00:00:00
\.


--
-- Name: master_jenis_surat_id_jenis_surat_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('master_jenis_surat_id_jenis_surat_seq', 5, true);


--
-- Data for Name: master_keaslian_surat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY master_keaslian_surat (id_keaslian_surat, nama_keaslian_surat) FROM stdin;
1	Asli
2	Tembusan
\.


--
-- Name: master_keaslian_surat_id_keaslian_surat_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('master_keaslian_surat_id_keaslian_surat_seq', 2, true);


--
-- Data for Name: master_role; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY master_role (id_role, level, nama_role, created_by, created_date, update_by, update_date) FROM stdin;
1	0	master	0	2017-12-05 06:32:20	0	2017-08-13 00:00:00
2	1	reseptionist	1	2017-12-05 06:32:20	1	2017-08-13 00:00:00
3	2	dekan	1	2017-12-05 06:32:20	1	2017-08-13 00:00:00
4	2	wakil dekan I	1	2017-12-05 06:32:20	1	2017-08-13 00:00:00
5	2	wakil dekan II	0	2017-12-05 06:32:20	0	2017-08-13 00:00:00
6	3	manager umum	0	2017-12-05 06:32:20	0	2017-08-13 00:00:00
8	5	koor pemegang uang muka	0	2017-12-05 06:32:20	0	2017-08-13 00:00:00
9	6	pimpinan	0	2017-12-20 20:18:08.769588	0	2017-12-20 20:18:08.769588
7	4	asisten manager keuangan	0	2017-12-05 06:32:20	0	2017-08-13 00:00:00
\.


--
-- Name: master_role_id_role_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('master_role_id_role_seq', 8, true);


--
-- Data for Name: master_status_keuangan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY master_status_keuangan (id_status_keuangan, nama_status_keuangan) FROM stdin;
1	Tidak ada
2	Verifikasi
3	Pembuatan SPP
4	Proses Rektorat
5	Selesai
\.


--
-- Name: master_status_keuangan_id_status_keuangan_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('master_status_keuangan_id_status_keuangan_seq', 5, true);


--
-- Data for Name: master_surat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY master_surat (id_surat, id_jenis_surat, id_keaslian_surat, no_urut_surat, perihal_surat, jumlah_lampiran, asal_surat, tujuan_surat, kode_surat, tanggal_pembuatan_surat, tanggal_terima_surat, deskripsi_surat, status, created_by, created_date, update_by, update_date) FROM stdin;
1	1	1	1	demo	1	rektorat	dekan fia	001	2017-12-05	2017-12-09	demo	t	3	2017-12-05 04:58:58	3	2017-12-05 04:58:58
2	1	1	22	dd	2	dddd	dddddd	1111	2017-12-20	2017-12-22		t	3	2018-12-20 07:59:17	3	2017-12-20 07:59:17
3	1	1	1	Tes	2	FT	FIA	XX/VV	2017-12-31	2018-01-03		f	3	2017-12-28 07:59:36	3	2017-12-28 07:59:36
4	1	1	1	KL	1	LK	PP	XX/BB	2017-12-29	2017-12-30		t	3	2017-12-28 08:13:18	3	2017-12-28 08:13:18
5	1	1	1	OK	2	OK	OKK	KL	2017-12-30	2018-01-05		t	3	2017-12-28 08:15:02	3	2017-12-28 08:15:02
6	1	1	1	MM	2	MM	MM	MM	2018-01-06	2018-01-06		t	3	2017-12-28 08:30:02	3	2017-12-28 08:30:02
7	1	1	1	CC	2	CC	CC	CC	2017-12-29	2018-01-05		t	3	2017-12-28 08:34:44	3	2017-12-28 08:34:44
8	1	1	2	UU	6	UU	UU	UU	2017-12-23	2017-12-08		t	3	2017-12-28 08:46:16	3	2017-12-28 08:46:16
9	1	1	1	II	2	II	II	II	2018-12-28	2018-12-29		t	3	2018-12-28 08:56:51	3	2018-12-28 08:56:51
10	1	1	1	SS	3	SS	SS	SS	2018-12-28	2019-01-02		t	3	2018-12-28 08:58:56	3	2018-12-28 08:58:56
12	1	1	2	ZZ	1	ZZ	ZZ	ZZ	2018-12-29	2019-01-01		t	3	2018-12-29 07:38:16	3	2018-12-29 07:38:16
13	1	1	3	qq	4	qq	qq	QQ	2018-12-29	2018-12-31		t	3	2018-12-29 07:43:53	3	2018-12-29 07:43:53
14	1	1	1	rr	2	rr	rr	RR	2019-12-29	2019-12-30		t	3	2019-12-29 07:45:48	3	2019-12-29 07:45:48
15	1	1	1	oo	4	oo	oo	OO	2019-12-19	2019-12-30		t	3	2019-12-29 07:48:21	3	2019-12-29 07:48:21
16	1	1	2	aq	6	aq	aq	AQ	2019-12-16	2019-12-17		t	3	2019-12-29 07:49:55	3	2019-12-29 07:49:55
17	1	1	1	vi	4	vi	vi	VI	2020-12-29	2020-12-30		t	3	2020-12-29 07:54:32	3	2020-12-29 07:54:32
18	1	1	2	vii	1	vii	vii	VII	2020-12-29	2020-12-30		t	3	2020-12-29 07:55:22	3	2020-12-29 07:55:22
11	1	1	4	YY	8	YY	YY	YY	2017-12-29	2017-12-30		t	3	2017-12-29 07:35:17	3	2017-12-29 08:16:29
19	1	1	5	JJ	7	JJ	JJ	JJ	2017-12-29	2017-12-30		t	3	2017-12-29 09:08:10	3	2017-12-29 09:08:10
\.


--
-- Name: master_surat_id_surat_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('master_surat_id_surat_seq', 19, true);


--
-- Data for Name: master_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY master_user (id_user, id_role, nama, username, password, nip, email, status, is_deleted, created_by, created_date, update_by, update_date) FROM stdin;
1	1	admin	admin	21232f297a57a5a743894a0e4a801fc3	1122	arvinchristian9@gmail.com	t	f	0	2017-12-05 06:32:38	1	2017-12-21 06:00:51
3	2	resep	resep	13016b898b3877960653191b72b2f03c	1	resep@resep.com	t	f	1	2017-12-05 04:33:57	3	2017-12-21 06:02:50
4	3	dekan	dekan	3da2f457ad7c0edf1c94e1ea87b0818d	2	dekan@dekan.com	t	f	1	2017-12-05 04:34:34	1	2017-12-22 07:52:27
5	4	wadek1	wadek1	a9ec7937badd2533411eb6ababa7f547	3	wadek1@wadek1.com	t	f	1	2017-12-05 04:35:11	1	2017-12-22 07:52:39
8	5	wadek2	wadek2	399c50b0a3f60097be0e554821be33cf	9	wadek2@wadek2.com	t	f	1	2017-12-05 04:43:01	1	2017-12-22 07:52:50
7	6	manum	manum	0aec0871fa2218fc79c74714c0296761	6	manum@manum.com	t	f	1	2017-12-05 04:36:56	1	2017-12-22 07:53:03
2	8	Rani Fariha	rani	b9f81618db3b0d7a8be8fd904cca8b6a	1234	rani@rani.com	t	f	1	2017-12-05 04:28:31	1	2017-12-22 07:53:12
9	9	pimpinan	pimpinan	90973652b88fe07d05a4304f0a945de8	99	pimpinan@pimpinan.com	t	f	1	2017-12-20 14:42:57	1	2017-12-22 07:53:38
6	7	asmankeu	asmankeu	281f6815b3cb75e0800fb443b546866c	5	asmankeu@asmankeu.com	t	f	1	2017-12-05 04:36:09	1	2017-12-22 07:54:38
\.


--
-- Name: master_user_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('master_user_id_user_seq', 9, true);


--
-- Data for Name: relasi_disposisi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY relasi_disposisi (id_disposisi, id_user_pengirim, id_user_penerima, id_status_keuangan, id_surat, deskripsi, is_approve, is_read, nominal_uang, deskripsi_keuangan, created_by, created_date, update_by, update_date) FROM stdin;
2	4	8	1	1		f	t	\N	\N	4	2017-12-05 05:07:29	4	2017-12-05 05:07:29
3	8	7	1	1		f	t	\N	\N	8	2017-12-05 05:08:15	8	2017-12-05 05:08:15
4	7	6	1	1		f	t	\N	\N	7	2017-12-05 05:13:54	7	2017-12-05 05:13:54
5	6	2	5	1		f	t	15000	somay	6	2017-12-05 05:14:21	6	2017-12-05 05:14:21
6	3	4	1	2		f	f	0	\N	3	2017-12-20 07:59:17	3	2017-12-20 07:59:17
1	3	4	1	1	demo	f	t	0	\N	3	2017-12-05 04:58:58	3	2017-12-05 04:58:58
7	3	4	1	3		f	f	0	\N	3	2017-12-28 07:59:36	3	2017-12-28 07:59:36
8	3	4	1	4		f	f	0	\N	3	2017-12-28 08:13:18	3	2017-12-28 08:13:18
9	3	4	1	5		f	f	0	\N	3	2017-12-28 08:15:02	3	2017-12-28 08:15:02
10	3	4	1	6		f	f	0	\N	3	2017-12-28 08:30:02	3	2017-12-28 08:30:02
11	3	4	1	7		f	f	0	\N	3	2017-12-28 08:34:44	3	2017-12-28 08:34:44
12	3	4	1	8		f	f	0	\N	3	2017-12-28 08:46:16	3	2017-12-28 08:46:16
13	3	4	1	9		f	f	0	\N	3	2018-12-28 08:56:51	3	2018-12-28 08:56:51
14	3	4	1	10		f	f	0	\N	3	2018-12-28 08:58:56	3	2018-12-28 08:58:56
16	3	4	1	12		f	f	0	\N	3	2018-12-29 07:38:16	3	2018-12-29 07:38:16
17	3	4	1	13		f	f	0	\N	3	2018-12-29 07:43:53	3	2018-12-29 07:43:53
19	3	4	1	15		f	f	0	\N	3	2019-12-29 07:48:21	3	2019-12-29 07:48:21
20	3	4	1	16		f	f	0	\N	3	2019-12-29 07:49:55	3	2019-12-29 07:49:55
21	3	4	1	17		f	f	0	\N	3	2020-12-29 07:54:32	3	2020-12-29 07:54:32
22	3	4	1	18		f	f	0	\N	3	2020-12-29 07:55:22	3	2020-12-29 07:55:22
18	3	4	1	14		f	t	0	\N	3	2019-12-29 07:45:48	3	2019-12-29 07:45:48
23	3	4	1	11	<p>tessss</p>	f	f	\N	\N	3	2017-12-29 08:24:46	3	2017-12-29 08:24:46
24	3	5	1	11	<p>tisssss</p>	f	t	\N	\N	3	2017-12-29 08:25:18	3	2017-12-29 08:25:18
15	3	5	1	11		f	t	0	\N	3	2017-12-29 08:16:29	3	2017-12-29 08:16:29
25	3	4	1	19		f	f	0	\N	3	2017-12-29 09:08:10	3	2017-12-29 09:08:10
\.


--
-- Name: relasi_disposisi_id_disposisi_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('relasi_disposisi_id_disposisi_seq', 25, true);


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
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

