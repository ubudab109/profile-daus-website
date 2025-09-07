import React, { Fragment } from "react";
import About from "../Components/About";
import Skill from "../Components/Skill";
import Resume from "../Components/Resume";
import Portfolio from "../Components/Portofolio";
import Contact from "../Components/Contact";
import PropTypes from 'prop-types';
import Header from "../Components/Header";
import Hero from "../Components/Hero";

const Main = ({ skills, experiences, portfolios }) => {
    return (
        <Fragment>
            {/* Mobile nav toggle button */}
            <i className="bi bi-list mobile-nav-toggle d-xl-none"></i>
            <Header />
            <Hero />
            <main id="main">
                {/* ABOUT SECTION */}
                <About />
                {/* SKILL */}
                <Skill skills={skills} />
                {/* Resume */}
                <Resume experiences={experiences} />
                {/* PORTOFOLIO */}
                <Portfolio portfolios={portfolios} />
                {/* CONTACT */}
                <Contact />
            </main>
        </Fragment>
    );
};

Main.propTypes = {
    skills: PropTypes.array.isRequired,
    experiences: PropTypes.array.isRequired,
    portfolios: PropTypes.array.isRequired,
};

export default Main;
