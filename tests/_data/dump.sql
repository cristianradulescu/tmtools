--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.1
-- Dumped by pg_dump version 9.6.1

-- Started on 2017-02-10 14:07:18 UTC

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12393)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2285 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = true;

--
-- TOC entry 185 (class 1259 OID 16386)
-- Name: company; Type: TABLE; Schema: public; Owner: travis
--

CREATE TABLE company (
    id integer NOT NULL,
    name character varying(45) NOT NULL,
    cost_center character varying(45) NOT NULL,
    division_manager_id integer
);


ALTER TABLE company OWNER TO travis;

--
-- TOC entry 190 (class 1259 OID 16439)
-- Name: company_id_seq; Type: SEQUENCE; Schema: public; Owner: travis
--

CREATE SEQUENCE company_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE company_id_seq OWNER TO travis;

--
-- TOC entry 2286 (class 0 OID 0)
-- Dependencies: 190
-- Name: company_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: travis
--

ALTER SEQUENCE company_id_seq OWNED BY company.id;


SET default_with_oids = false;

--
-- TOC entry 189 (class 1259 OID 16429)
-- Name: document; Type: TABLE; Schema: public; Owner: travis
--

CREATE TABLE document (
    id integer NOT NULL,
    type_id integer NOT NULL,
    status_id integer NOT NULL,
    employee_id integer NOT NULL
);


ALTER TABLE document OWNER TO travis;

--
-- TOC entry 188 (class 1259 OID 16427)
-- Name: document_id_seq; Type: SEQUENCE; Schema: public; Owner: travis
--

CREATE SEQUENCE document_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE document_id_seq OWNER TO travis;

--
-- TOC entry 2287 (class 0 OID 0)
-- Dependencies: 188
-- Name: document_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: travis
--

ALTER SEQUENCE document_id_seq OWNED BY document.id;


--
-- TOC entry 194 (class 1259 OID 16450)
-- Name: document_status; Type: TABLE; Schema: public; Owner: travis
--

CREATE TABLE document_status (
    id integer NOT NULL,
    name character varying(45) NOT NULL
);


ALTER TABLE document_status OWNER TO travis;

--
-- TOC entry 193 (class 1259 OID 16448)
-- Name: document_status_id_seq; Type: SEQUENCE; Schema: public; Owner: travis
--

CREATE SEQUENCE document_status_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE document_status_id_seq OWNER TO travis;

--
-- TOC entry 2288 (class 0 OID 0)
-- Dependencies: 193
-- Name: document_status_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: travis
--

ALTER SEQUENCE document_status_id_seq OWNED BY document_status.id;


--
-- TOC entry 196 (class 1259 OID 16484)
-- Name: document_type; Type: TABLE; Schema: public; Owner: travis
--

CREATE TABLE document_type (
    id integer NOT NULL,
    name character varying(45) NOT NULL,
    template character varying(200)
);


ALTER TABLE document_type OWNER TO travis;

--
-- TOC entry 195 (class 1259 OID 16482)
-- Name: document_type_id_seq; Type: SEQUENCE; Schema: public; Owner: travis
--

CREATE SEQUENCE document_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE document_type_id_seq OWNER TO travis;

--
-- TOC entry 2289 (class 0 OID 0)
-- Dependencies: 195
-- Name: document_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: travis
--

ALTER SEQUENCE document_type_id_seq OWNED BY document_type.id;


--
-- TOC entry 186 (class 1259 OID 16389)
-- Name: employee; Type: TABLE; Schema: public; Owner: travis
--

CREATE TABLE employee (
    id integer NOT NULL,
    first_name character varying(45) NOT NULL,
    last_name character varying(45) NOT NULL,
    username character varying(45),
    birthday date,
    personal_numeric_code bigint NOT NULL,
    identity_card_number character(9) NOT NULL,
    job_title_id integer NOT NULL,
    division_manager_id integer,
    company_id integer NOT NULL
);


ALTER TABLE employee OWNER TO travis;

--
-- TOC entry 191 (class 1259 OID 16442)
-- Name: employee_id_seq; Type: SEQUENCE; Schema: public; Owner: travis
--

CREATE SEQUENCE employee_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE employee_id_seq OWNER TO travis;

--
-- TOC entry 2290 (class 0 OID 0)
-- Dependencies: 191
-- Name: employee_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: travis
--

ALTER SEQUENCE employee_id_seq OWNED BY employee.id;


--
-- TOC entry 187 (class 1259 OID 16392)
-- Name: employee_job_title; Type: TABLE; Schema: public; Owner: travis
--

CREATE TABLE employee_job_title (
    id integer NOT NULL,
    name character varying(45) NOT NULL
);


ALTER TABLE employee_job_title OWNER TO travis;

--
-- TOC entry 192 (class 1259 OID 16445)
-- Name: employee_job_title_id_seq; Type: SEQUENCE; Schema: public; Owner: travis
--

CREATE SEQUENCE employee_job_title_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE employee_job_title_id_seq OWNER TO travis;

--
-- TOC entry 2291 (class 0 OID 0)
-- Dependencies: 192
-- Name: employee_job_title_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: travis
--

ALTER SEQUENCE employee_job_title_id_seq OWNED BY employee_job_title.id;


--
-- TOC entry 207 (class 1259 OID 16671)
-- Name: fos_user; Type: TABLE; Schema: public; Owner: travis
--

CREATE TABLE fos_user (
    id integer NOT NULL,
    username character varying(180) NOT NULL,
    username_canonical character varying(180) NOT NULL,
    email character varying(180) NOT NULL,
    email_canonical character varying(180) NOT NULL,
    enabled boolean NOT NULL,
    salt character varying(255) DEFAULT NULL::character varying,
    password character varying(255) NOT NULL,
    last_login timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    confirmation_token character varying(180) DEFAULT NULL::character varying,
    password_requested_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    roles text NOT NULL
);


ALTER TABLE fos_user OWNER TO travis;

--
-- TOC entry 2292 (class 0 OID 0)
-- Dependencies: 207
-- Name: COLUMN fos_user.roles; Type: COMMENT; Schema: public; Owner: travis
--

COMMENT ON COLUMN fos_user.roles IS '(DC2Type:array)';


--
-- TOC entry 208 (class 1259 OID 16687)
-- Name: fos_user_id_seq; Type: SEQUENCE; Schema: public; Owner: travis
--

CREATE SEQUENCE fos_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE fos_user_id_seq OWNER TO travis;

--
-- TOC entry 198 (class 1259 OID 16531)
-- Name: reimbursement; Type: TABLE; Schema: public; Owner: travis
--

CREATE TABLE reimbursement (
    id integer NOT NULL,
    type_id integer NOT NULL,
    number character varying(45) NOT NULL,
    date date NOT NULL,
    value numeric(10,2) NOT NULL,
    employee_id integer NOT NULL,
    document_id integer
);


ALTER TABLE reimbursement OWNER TO travis;

--
-- TOC entry 197 (class 1259 OID 16529)
-- Name: reimbursement_id_seq; Type: SEQUENCE; Schema: public; Owner: travis
--

CREATE SEQUENCE reimbursement_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reimbursement_id_seq OWNER TO travis;

--
-- TOC entry 2293 (class 0 OID 0)
-- Dependencies: 197
-- Name: reimbursement_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: travis
--

ALTER SEQUENCE reimbursement_id_seq OWNED BY reimbursement.id;


--
-- TOC entry 200 (class 1259 OID 16540)
-- Name: reimbursement_type; Type: TABLE; Schema: public; Owner: travis
--

CREATE TABLE reimbursement_type (
    id integer NOT NULL,
    name character varying(45) NOT NULL
);


ALTER TABLE reimbursement_type OWNER TO travis;

--
-- TOC entry 199 (class 1259 OID 16538)
-- Name: reimbursement_type_id_seq; Type: SEQUENCE; Schema: public; Owner: travis
--

CREATE SEQUENCE reimbursement_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reimbursement_type_id_seq OWNER TO travis;

--
-- TOC entry 2294 (class 0 OID 0)
-- Dependencies: 199
-- Name: reimbursement_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: travis
--

ALTER SEQUENCE reimbursement_type_id_seq OWNED BY reimbursement_type.id;


--
-- TOC entry 202 (class 1259 OID 16558)
-- Name: travel; Type: TABLE; Schema: public; Owner: travis
--

CREATE TABLE travel (
    id integer NOT NULL,
    purpose_id integer NOT NULL,
    destination_id integer NOT NULL,
    employee_id integer NOT NULL,
    date_start date NOT NULL,
    date_end date NOT NULL,
    departure_leave_time timestamp without time zone NOT NULL,
    destination_arrival_time timestamp without time zone NOT NULL,
    destination_leave_time timestamp without time zone NOT NULL,
    departure_arrival_time timestamp without time zone NOT NULL,
    document_id integer
);


ALTER TABLE travel OWNER TO travis;

--
-- TOC entry 204 (class 1259 OID 16566)
-- Name: travel_destination; Type: TABLE; Schema: public; Owner: travis
--

CREATE TABLE travel_destination (
    id integer NOT NULL,
    name character varying(45) NOT NULL
);


ALTER TABLE travel_destination OWNER TO travis;

--
-- TOC entry 203 (class 1259 OID 16564)
-- Name: travel_destination_id_seq; Type: SEQUENCE; Schema: public; Owner: travis
--

CREATE SEQUENCE travel_destination_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE travel_destination_id_seq OWNER TO travis;

--
-- TOC entry 2295 (class 0 OID 0)
-- Dependencies: 203
-- Name: travel_destination_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: travis
--

ALTER SEQUENCE travel_destination_id_seq OWNED BY travel_destination.id;


--
-- TOC entry 201 (class 1259 OID 16556)
-- Name: travel_id_seq; Type: SEQUENCE; Schema: public; Owner: travis
--

CREATE SEQUENCE travel_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE travel_id_seq OWNER TO travis;

--
-- TOC entry 2296 (class 0 OID 0)
-- Dependencies: 201
-- Name: travel_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: travis
--

ALTER SEQUENCE travel_id_seq OWNED BY travel.id;


--
-- TOC entry 206 (class 1259 OID 16574)
-- Name: travel_purpose; Type: TABLE; Schema: public; Owner: travis
--

CREATE TABLE travel_purpose (
    id integer NOT NULL,
    name character varying(100) NOT NULL
);


ALTER TABLE travel_purpose OWNER TO travis;

--
-- TOC entry 205 (class 1259 OID 16572)
-- Name: travel_purpose_id_seq; Type: SEQUENCE; Schema: public; Owner: travis
--

CREATE SEQUENCE travel_purpose_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE travel_purpose_id_seq OWNER TO travis;

--
-- TOC entry 2297 (class 0 OID 0)
-- Dependencies: 205
-- Name: travel_purpose_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: travis
--

ALTER SEQUENCE travel_purpose_id_seq OWNED BY travel_purpose.id;


--
-- TOC entry 2074 (class 2604 OID 16432)
-- Name: document id; Type: DEFAULT; Schema: public; Owner: travis
--

ALTER TABLE ONLY document ALTER COLUMN id SET DEFAULT nextval('document_id_seq'::regclass);


--
-- TOC entry 2075 (class 2604 OID 16453)
-- Name: document_status id; Type: DEFAULT; Schema: public; Owner: travis
--

ALTER TABLE ONLY document_status ALTER COLUMN id SET DEFAULT nextval('document_status_id_seq'::regclass);


--
-- TOC entry 2076 (class 2604 OID 16487)
-- Name: document_type id; Type: DEFAULT; Schema: public; Owner: travis
--

ALTER TABLE ONLY document_type ALTER COLUMN id SET DEFAULT nextval('document_type_id_seq'::regclass);


--
-- TOC entry 2072 (class 2604 OID 16444)
-- Name: employee id; Type: DEFAULT; Schema: public; Owner: travis
--

ALTER TABLE ONLY employee ALTER COLUMN id SET DEFAULT nextval('employee_id_seq'::regclass);


--
-- TOC entry 2073 (class 2604 OID 16447)
-- Name: employee_job_title id; Type: DEFAULT; Schema: public; Owner: travis
--

ALTER TABLE ONLY employee_job_title ALTER COLUMN id SET DEFAULT nextval('employee_job_title_id_seq'::regclass);


--
-- TOC entry 2077 (class 2604 OID 16534)
-- Name: reimbursement id; Type: DEFAULT; Schema: public; Owner: travis
--

ALTER TABLE ONLY reimbursement ALTER COLUMN id SET DEFAULT nextval('reimbursement_id_seq'::regclass);


--
-- TOC entry 2078 (class 2604 OID 16543)
-- Name: reimbursement_type id; Type: DEFAULT; Schema: public; Owner: travis
--

ALTER TABLE ONLY reimbursement_type ALTER COLUMN id SET DEFAULT nextval('reimbursement_type_id_seq'::regclass);


--
-- TOC entry 2079 (class 2604 OID 16561)
-- Name: travel id; Type: DEFAULT; Schema: public; Owner: travis
--

ALTER TABLE ONLY travel ALTER COLUMN id SET DEFAULT nextval('travel_id_seq'::regclass);


--
-- TOC entry 2080 (class 2604 OID 16569)
-- Name: travel_destination id; Type: DEFAULT; Schema: public; Owner: travis
--

ALTER TABLE ONLY travel_destination ALTER COLUMN id SET DEFAULT nextval('travel_destination_id_seq'::regclass);


--
-- TOC entry 2081 (class 2604 OID 16577)
-- Name: travel_purpose id; Type: DEFAULT; Schema: public; Owner: travis
--

ALTER TABLE ONLY travel_purpose ALTER COLUMN id SET DEFAULT nextval('travel_purpose_id_seq'::regclass);


--
-- TOC entry 2255 (class 0 OID 16386)
-- Dependencies: 185
-- Data for Name: company; Type: TABLE DATA; Schema: public; Owner: travis
--

INSERT INTO company (id, name, cost_center, division_manager_id) VALUES (2, 'eMAG', '12RO123456', 3);


--
-- TOC entry 2298 (class 0 OID 0)
-- Dependencies: 190
-- Name: company_id_seq; Type: SEQUENCE SET; Schema: public; Owner: travis
--

SELECT pg_catalog.setval('company_id_seq', 2, true);


--
-- TOC entry 2259 (class 0 OID 16429)
-- Dependencies: 189
-- Data for Name: document; Type: TABLE DATA; Schema: public; Owner: travis
--

INSERT INTO document (id, type_id, status_id, employee_id) VALUES (1, 1, 1, 3);
INSERT INTO document (id, type_id, status_id, employee_id) VALUES (2, 2, 1, 3);


--
-- TOC entry 2299 (class 0 OID 0)
-- Dependencies: 188
-- Name: document_id_seq; Type: SEQUENCE SET; Schema: public; Owner: travis
--

SELECT pg_catalog.setval('document_id_seq', 2, true);


--
-- TOC entry 2264 (class 0 OID 16450)
-- Dependencies: 194
-- Data for Name: document_status; Type: TABLE DATA; Schema: public; Owner: travis
--

INSERT INTO document_status (id, name) VALUES (1, 'New');
INSERT INTO document_status (id, name) VALUES (2, 'Pending');
INSERT INTO document_status (id, name) VALUES (3, 'Completed');


--
-- TOC entry 2300 (class 0 OID 0)
-- Dependencies: 193
-- Name: document_status_id_seq; Type: SEQUENCE SET; Schema: public; Owner: travis
--

SELECT pg_catalog.setval('document_status_id_seq', 3, true);


--
-- TOC entry 2266 (class 0 OID 16484)
-- Dependencies: 196
-- Data for Name: document_type; Type: TABLE DATA; Schema: public; Owner: travis
--

INSERT INTO document_type (id, name, template) VALUES (2, 'Reimbursement', 'reimbursement_document.svg');
INSERT INTO document_type (id, name, template) VALUES (3, 'Service aquisition', 'service_aquisition.svg');
INSERT INTO document_type (id, name, template) VALUES (1, 'Travel', 'travel_document.svg');


--
-- TOC entry 2301 (class 0 OID 0)
-- Dependencies: 195
-- Name: document_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: travis
--

SELECT pg_catalog.setval('document_type_id_seq', 3, true);


--
-- TOC entry 2256 (class 0 OID 16389)
-- Dependencies: 186
-- Data for Name: employee; Type: TABLE DATA; Schema: public; Owner: travis
--

INSERT INTO employee (id, first_name, last_name, username, birthday, personal_numeric_code, identity_card_number, job_title_id, division_manager_id, company_id) VALUES (3, 'Cristian', 'Radulescu', 'cristian.radulescu', '2017-01-29', 1840706160081, 'DX 736232', 1, 3, 2);


--
-- TOC entry 2302 (class 0 OID 0)
-- Dependencies: 191
-- Name: employee_id_seq; Type: SEQUENCE SET; Schema: public; Owner: travis
--

SELECT pg_catalog.setval('employee_id_seq', 3, true);


--
-- TOC entry 2257 (class 0 OID 16392)
-- Dependencies: 187
-- Data for Name: employee_job_title; Type: TABLE DATA; Schema: public; Owner: travis
--

INSERT INTO employee_job_title (id, name) VALUES (1, 'Team Manager');
INSERT INTO employee_job_title (id, name) VALUES (2, 'PHP Developer');


--
-- TOC entry 2303 (class 0 OID 0)
-- Dependencies: 192
-- Name: employee_job_title_id_seq; Type: SEQUENCE SET; Schema: public; Owner: travis
--

SELECT pg_catalog.setval('employee_job_title_id_seq', 2, true);


--
-- TOC entry 2277 (class 0 OID 16671)
-- Dependencies: 207
-- Data for Name: fos_user; Type: TABLE DATA; Schema: public; Owner: travis
--

INSERT INTO fos_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles) VALUES (1, 'test', 'test', 'test', 'test', true, NULL, '$2y$13$qBjRacI0XwJ4/xCzF9BTCeOLmN2mNcuUvZJbYdCT7ACtjXjTDmkVm', '2017-02-09 13:56:39', NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}');

--
-- TOC entry 2304 (class 0 OID 0)
-- Dependencies: 208
-- Name: fos_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: travis
--

SELECT pg_catalog.setval('fos_user_id_seq', 1, false);


--
-- TOC entry 2268 (class 0 OID 16531)
-- Dependencies: 198
-- Data for Name: reimbursement; Type: TABLE DATA; Schema: public; Owner: travis
--

INSERT INTO reimbursement (id, type_id, number, date, value, employee_id, document_id) VALUES (1, 1, '111', '2017-02-08', 65.00, 3, 2);


--
-- TOC entry 2305 (class 0 OID 0)
-- Dependencies: 197
-- Name: reimbursement_id_seq; Type: SEQUENCE SET; Schema: public; Owner: travis
--

SELECT pg_catalog.setval('reimbursement_id_seq', 1, true);


--
-- TOC entry 2270 (class 0 OID 16540)
-- Dependencies: 200
-- Data for Name: reimbursement_type; Type: TABLE DATA; Schema: public; Owner: travis
--

INSERT INTO reimbursement_type (id, name) VALUES (1, 'Train ticket');


--
-- TOC entry 2306 (class 0 OID 0)
-- Dependencies: 199
-- Name: reimbursement_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: travis
--

SELECT pg_catalog.setval('reimbursement_type_id_seq', 1, true);


--
-- TOC entry 2272 (class 0 OID 16558)
-- Dependencies: 202
-- Data for Name: travel; Type: TABLE DATA; Schema: public; Owner: travis
--

INSERT INTO travel (id, purpose_id, destination_id, employee_id, date_start, date_end, departure_leave_time, destination_arrival_time, destination_leave_time, departure_arrival_time, document_id) VALUES (1, 1, 1, 3, '2017-02-01', '2017-02-03', '2017-02-01 06:00:00', '2017-02-01 09:00:00', '2017-02-03 18:00:00', '2017-02-03 21:30:00', 1);


--
-- TOC entry 2274 (class 0 OID 16566)
-- Dependencies: 204
-- Data for Name: travel_destination; Type: TABLE DATA; Schema: public; Owner: travis
--

INSERT INTO travel_destination (id, name) VALUES (1, 'Bucharest');


--
-- TOC entry 2307 (class 0 OID 0)
-- Dependencies: 203
-- Name: travel_destination_id_seq; Type: SEQUENCE SET; Schema: public; Owner: travis
--

SELECT pg_catalog.setval('travel_destination_id_seq', 1, true);


--
-- TOC entry 2308 (class 0 OID 0)
-- Dependencies: 201
-- Name: travel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: travis
--

SELECT pg_catalog.setval('travel_id_seq', 1, true);


--
-- TOC entry 2276 (class 0 OID 16574)
-- Dependencies: 206
-- Data for Name: travel_purpose; Type: TABLE DATA; Schema: public; Owner: travis
--

INSERT INTO travel_purpose (id, name) VALUES (1, 'Meeting');


--
-- TOC entry 2309 (class 0 OID 0)
-- Dependencies: 205
-- Name: travel_purpose_id_seq; Type: SEQUENCE SET; Schema: public; Owner: travis
--

SELECT pg_catalog.setval('travel_purpose_id_seq', 1, true);


--
-- TOC entry 2088 (class 2606 OID 16396)
-- Name: company company_pkey; Type: CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY company
    ADD CONSTRAINT company_pkey PRIMARY KEY (id);


--
-- TOC entry 2097 (class 2606 OID 16434)
-- Name: document document_pkey; Type: CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY document
    ADD CONSTRAINT document_pkey PRIMARY KEY (id);


--
-- TOC entry 2100 (class 2606 OID 16455)
-- Name: document_status document_status_pkey; Type: CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY document_status
    ADD CONSTRAINT document_status_pkey PRIMARY KEY (id);


--
-- TOC entry 2103 (class 2606 OID 16490)
-- Name: document_type document_type_pkey; Type: CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY document_type
    ADD CONSTRAINT document_type_pkey PRIMARY KEY (id);


--
-- TOC entry 2092 (class 2606 OID 16398)
-- Name: employee employee_pkey; Type: CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY employee
    ADD CONSTRAINT employee_pkey PRIMARY KEY (id);


--
-- TOC entry 2120 (class 2606 OID 16682)
-- Name: fos_user fos_user_pkey; Type: CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY fos_user
    ADD CONSTRAINT fos_user_pkey PRIMARY KEY (id);


--
-- TOC entry 2095 (class 2606 OID 16402)
-- Name: employee_job_title job_title_pkey; Type: CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY employee_job_title
    ADD CONSTRAINT job_title_pkey PRIMARY KEY (id);


--
-- TOC entry 2105 (class 2606 OID 16536)
-- Name: reimbursement reimbursement_pkey; Type: CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY reimbursement
    ADD CONSTRAINT reimbursement_pkey PRIMARY KEY (id);


--
-- TOC entry 2108 (class 2606 OID 16545)
-- Name: reimbursement_type reimbursement_type_pkey; Type: CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY reimbursement_type
    ADD CONSTRAINT reimbursement_type_pkey PRIMARY KEY (id);


--
-- TOC entry 2113 (class 2606 OID 16732)
-- Name: travel_destination travel_destination_name_unique; Type: CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY travel_destination
    ADD CONSTRAINT travel_destination_name_unique UNIQUE (name);


--
-- TOC entry 2115 (class 2606 OID 16571)
-- Name: travel_destination travel_destination_pkey; Type: CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY travel_destination
    ADD CONSTRAINT travel_destination_pkey PRIMARY KEY (id);


--
-- TOC entry 2110 (class 2606 OID 16563)
-- Name: travel travel_pkey; Type: CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY travel
    ADD CONSTRAINT travel_pkey PRIMARY KEY (id);


--
-- TOC entry 2118 (class 2606 OID 16579)
-- Name: travel_purpose travel_purpose_pkey; Type: CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY travel_purpose
    ADD CONSTRAINT travel_purpose_pkey PRIMARY KEY (id);


--
-- TOC entry 2086 (class 1259 OID 16735)
-- Name: company_cost_center_uindex; Type: INDEX; Schema: public; Owner: travis
--

CREATE UNIQUE INDEX company_cost_center_uindex ON company USING btree (cost_center);


--
-- TOC entry 2098 (class 1259 OID 16748)
-- Name: document_status_name_uindex; Type: INDEX; Schema: public; Owner: travis
--

CREATE UNIQUE INDEX document_status_name_uindex ON document_status USING btree (name);


--
-- TOC entry 2101 (class 1259 OID 16749)
-- Name: document_type_name_uindex; Type: INDEX; Schema: public; Owner: travis
--

CREATE UNIQUE INDEX document_type_name_uindex ON document_type USING btree (name);


--
-- TOC entry 2089 (class 1259 OID 16751)
-- Name: employee_identity_card_number_uindex; Type: INDEX; Schema: public; Owner: travis
--

CREATE UNIQUE INDEX employee_identity_card_number_uindex ON employee USING btree (identity_card_number);


--
-- TOC entry 2093 (class 1259 OID 16752)
-- Name: employee_job_title_uindex; Type: INDEX; Schema: public; Owner: travis
--

CREATE UNIQUE INDEX employee_job_title_uindex ON employee_job_title USING btree (name);


--
-- TOC entry 2090 (class 1259 OID 16750)
-- Name: employee_personal_numeric_code_uindex; Type: INDEX; Schema: public; Owner: travis
--

CREATE UNIQUE INDEX employee_personal_numeric_code_uindex ON employee USING btree (personal_numeric_code);


--
-- TOC entry 2106 (class 1259 OID 16753)
-- Name: reimbursement_type_name_uindex; Type: INDEX; Schema: public; Owner: travis
--

CREATE UNIQUE INDEX reimbursement_type_name_uindex ON reimbursement_type USING btree (name);


--
-- TOC entry 2111 (class 1259 OID 16754)
-- Name: travel_destination_name_uindex; Type: INDEX; Schema: public; Owner: travis
--

CREATE UNIQUE INDEX travel_destination_name_uindex ON travel_destination USING btree (name);


--
-- TOC entry 2116 (class 1259 OID 16755)
-- Name: travel_purpose_name_uindex; Type: INDEX; Schema: public; Owner: travis
--

CREATE UNIQUE INDEX travel_purpose_name_uindex ON travel_purpose USING btree (name);


--
-- TOC entry 2121 (class 1259 OID 16683)
-- Name: uniq_957a647992fc23a8; Type: INDEX; Schema: public; Owner: travis
--

CREATE UNIQUE INDEX uniq_957a647992fc23a8 ON fos_user USING btree (username_canonical);


--
-- TOC entry 2122 (class 1259 OID 16684)
-- Name: uniq_957a6479a0d96fbf; Type: INDEX; Schema: public; Owner: travis
--

CREATE UNIQUE INDEX uniq_957a6479a0d96fbf ON fos_user USING btree (email_canonical);


--
-- TOC entry 2123 (class 1259 OID 16685)
-- Name: uniq_957a6479c05fb297; Type: INDEX; Schema: public; Owner: travis
--

CREATE UNIQUE INDEX uniq_957a6479c05fb297 ON fos_user USING btree (confirmation_token);


--
-- TOC entry 2124 (class 2606 OID 16742)
-- Name: company company_division_manager_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY company
    ADD CONSTRAINT company_division_manager_id_fk FOREIGN KEY (division_manager_id) REFERENCES employee(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2128 (class 2606 OID 16457)
-- Name: document document_document_status_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY document
    ADD CONSTRAINT document_document_status_id_fk FOREIGN KEY (status_id) REFERENCES document_status(id) ON UPDATE CASCADE;


--
-- TOC entry 2129 (class 2606 OID 16524)
-- Name: document document_document_type_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY document
    ADD CONSTRAINT document_document_type_id_fk FOREIGN KEY (type_id) REFERENCES document_type(id) ON UPDATE CASCADE;


--
-- TOC entry 2130 (class 2606 OID 16761)
-- Name: document document_employee_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY document
    ADD CONSTRAINT document_employee_id_fk FOREIGN KEY (employee_id) REFERENCES employee(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2127 (class 2606 OID 16477)
-- Name: employee employee_company_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY employee
    ADD CONSTRAINT employee_company_id_fk FOREIGN KEY (company_id) REFERENCES company(id) ON UPDATE CASCADE;


--
-- TOC entry 2126 (class 2606 OID 16472)
-- Name: employee employee_division_manager_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY employee
    ADD CONSTRAINT employee_division_manager_id_fk FOREIGN KEY (division_manager_id) REFERENCES employee(id) ON UPDATE CASCADE;


--
-- TOC entry 2125 (class 2606 OID 16467)
-- Name: employee employee_job_title_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY employee
    ADD CONSTRAINT employee_job_title_id_fk FOREIGN KEY (job_title_id) REFERENCES employee_job_title(id) ON UPDATE CASCADE;


--
-- TOC entry 2132 (class 2606 OID 16551)
-- Name: reimbursement reimbursement_document_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY reimbursement
    ADD CONSTRAINT reimbursement_document_id_fk FOREIGN KEY (document_id) REFERENCES document(id) ON UPDATE CASCADE;


--
-- TOC entry 2133 (class 2606 OID 16580)
-- Name: reimbursement reimbursement_employee_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY reimbursement
    ADD CONSTRAINT reimbursement_employee_id_fk FOREIGN KEY (employee_id) REFERENCES employee(id) ON UPDATE CASCADE;


--
-- TOC entry 2131 (class 2606 OID 16546)
-- Name: reimbursement reimbursement_reimbursement_type_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY reimbursement
    ADD CONSTRAINT reimbursement_reimbursement_type_id_fk FOREIGN KEY (type_id) REFERENCES reimbursement_type(id) ON UPDATE CASCADE;


--
-- TOC entry 2137 (class 2606 OID 16756)
-- Name: travel travel_document_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY travel
    ADD CONSTRAINT travel_document_id_fk FOREIGN KEY (document_id) REFERENCES document(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2136 (class 2606 OID 16595)
-- Name: travel travel_employee_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY travel
    ADD CONSTRAINT travel_employee_id_fk FOREIGN KEY (employee_id) REFERENCES employee(id) ON UPDATE CASCADE;


--
-- TOC entry 2135 (class 2606 OID 16590)
-- Name: travel travel_travel_destination_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY travel
    ADD CONSTRAINT travel_travel_destination_id_fk FOREIGN KEY (destination_id) REFERENCES travel_destination(id) ON UPDATE CASCADE;


--
-- TOC entry 2134 (class 2606 OID 16585)
-- Name: travel travel_travel_purpose_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: travis
--

ALTER TABLE ONLY travel
    ADD CONSTRAINT travel_travel_purpose_id_fk FOREIGN KEY (purpose_id) REFERENCES travel_purpose(id) ON UPDATE CASCADE;


-- Completed on 2017-02-10 14:07:18 UTC

--
-- PostgreSQL database dump complete
--
