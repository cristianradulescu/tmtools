--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.1
-- Dumped by pg_dump version 9.6.1

-- Started on 2017-02-08 16:28:28 UTC

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
-- TOC entry 2153 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 186 (class 1259 OID 16391)
-- Name: company; Type: TABLE; Schema: public; Owner: tmtoolsuser
--

CREATE TABLE company (
    id integer NOT NULL,
    name character(45) NOT NULL,
    cost_center character(25) NOT NULL,
    division_manager_id integer NOT NULL
);


ALTER TABLE company OWNER TO tmtoolsuser;

--
-- TOC entry 185 (class 1259 OID 16386)
-- Name: employee; Type: TABLE; Schema: public; Owner: tmtoolsuser
--

CREATE TABLE employee (
    id integer NOT NULL,
    first_name character(45) NOT NULL,
    last_name character(45) NOT NULL,
    username character(45),
    birthday date,
    personal_numeric_code bigint NOT NULL,
    identity_card_number character(9) NOT NULL,
    job_title_id integer NOT NULL,
    division_manager_id integer NOT NULL,
    company_id integer NOT NULL
);


ALTER TABLE employee OWNER TO tmtoolsuser;

--
-- TOC entry 187 (class 1259 OID 24578)
-- Name: employee_job_title; Type: TABLE; Schema: public; Owner: tmtoolsuser
--

CREATE TABLE employee_job_title (
    id integer NOT NULL,
    name character(45) NOT NULL
);


ALTER TABLE employee_job_title OWNER TO tmtoolsuser;

--
-- TOC entry 2145 (class 0 OID 16391)
-- Dependencies: 186
-- Data for Name: company; Type: TABLE DATA; Schema: public; Owner: tmtoolsuser
--

COPY company (id, name, cost_center, division_manager_id) FROM stdin;
\.


--
-- TOC entry 2144 (class 0 OID 16386)
-- Dependencies: 185
-- Data for Name: employee; Type: TABLE DATA; Schema: public; Owner: tmtoolsuser
--

COPY employee (id, first_name, last_name, username, birthday, personal_numeric_code, identity_card_number, job_title_id, division_manager_id, company_id) FROM stdin;
\.


--
-- TOC entry 2146 (class 0 OID 24578)
-- Dependencies: 187
-- Data for Name: employee_job_title; Type: TABLE DATA; Schema: public; Owner: tmtoolsuser
--

COPY employee_job_title (id, name) FROM stdin;
\.


--
-- TOC entry 2018 (class 2606 OID 16395)
-- Name: company company_pkey; Type: CONSTRAINT; Schema: public; Owner: tmtoolsuser
--

ALTER TABLE ONLY company
    ADD CONSTRAINT company_pkey PRIMARY KEY (id);


--
-- TOC entry 2012 (class 2606 OID 16390)
-- Name: employee employee_pkey; Type: CONSTRAINT; Schema: public; Owner: tmtoolsuser
--

ALTER TABLE ONLY employee
    ADD CONSTRAINT employee_pkey PRIMARY KEY (id);


--
-- TOC entry 2014 (class 2606 OID 16407)
-- Name: employee identity_card_number_UNIQUE; Type: CONSTRAINT; Schema: public; Owner: tmtoolsuser
--

ALTER TABLE ONLY employee
    ADD CONSTRAINT "identity_card_number_UNIQUE" UNIQUE (identity_card_number);


--
-- TOC entry 2020 (class 2606 OID 24582)
-- Name: employee_job_title job_title_pkey; Type: CONSTRAINT; Schema: public; Owner: tmtoolsuser
--

ALTER TABLE ONLY employee_job_title
    ADD CONSTRAINT job_title_pkey PRIMARY KEY (id);


--
-- TOC entry 2022 (class 2606 OID 24584)
-- Name: employee_job_title name_UNIQUE; Type: CONSTRAINT; Schema: public; Owner: tmtoolsuser
--

ALTER TABLE ONLY employee_job_title
    ADD CONSTRAINT "name_UNIQUE" UNIQUE (name);


--
-- TOC entry 2016 (class 2606 OID 16405)
-- Name: employee personal_numeric_code_UNIQUE; Type: CONSTRAINT; Schema: public; Owner: tmtoolsuser
--

ALTER TABLE ONLY employee
    ADD CONSTRAINT "personal_numeric_code_UNIQUE" UNIQUE (personal_numeric_code);


--
-- TOC entry 2026 (class 2606 OID 24585)
-- Name: company FK_company_division_manager; Type: FK CONSTRAINT; Schema: public; Owner: tmtoolsuser
--

ALTER TABLE ONLY company
    ADD CONSTRAINT "FK_company_division_manager" FOREIGN KEY (division_manager_id) REFERENCES employee(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2023 (class 2606 OID 16408)
-- Name: employee FK_employee_company; Type: FK CONSTRAINT; Schema: public; Owner: tmtoolsuser
--

ALTER TABLE ONLY employee
    ADD CONSTRAINT "FK_employee_company" FOREIGN KEY (company_id) REFERENCES company(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2024 (class 2606 OID 16418)
-- Name: employee FK_employee_division_manager; Type: FK CONSTRAINT; Schema: public; Owner: tmtoolsuser
--

ALTER TABLE ONLY employee
    ADD CONSTRAINT "FK_employee_division_manager" FOREIGN KEY (division_manager_id) REFERENCES employee(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2025 (class 2606 OID 24590)
-- Name: employee FK_employee_job_title; Type: FK CONSTRAINT; Schema: public; Owner: tmtoolsuser
--

ALTER TABLE ONLY employee
    ADD CONSTRAINT "FK_employee_job_title" FOREIGN KEY (job_title_id) REFERENCES employee_job_title(id) ON UPDATE CASCADE ON DELETE RESTRICT;


-- Completed on 2017-02-08 16:28:28 UTC

--
-- PostgreSQL database dump complete
--

