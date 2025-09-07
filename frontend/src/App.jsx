/* eslint-disable react-hooks/exhaustive-deps */
import { useEffect, useState } from "react";
import About from "./Components/About";
import Header from "./Components/Header";
import Hero from "./Components/Hero";
import AOS from "aos";
import "aos/dist/aos.css";
import Skill from "./Components/Skill";
import Resume from "./Components/Resume";
import Portfolio from "./Components/Portofolio";
import Footer from "./Components/Footer";
import Contact from "./Components/Contact";
import axios from "axios";

function App() {
    const url = process.env.REACT_APP_BE_URL;
    const [experiences, setExperiences] = useState([]);
    const [skills, setSkills] = useState([]);
    const [portfolios, setPortfolios] = useState([]);
    const [isLoading, setIsLoading] = useState(true);

    const getSkills = async () => {
        await axios
            .get(`${url}/skills`)
            .then((res) => {
                const data = res;
                setSkills(data.data);
            })
            .catch((err) => {
                alert("Error when fetching data");
            });
    };

    const getExperiences = async () => {
        await axios
            .get(`${url}/experiences`)
            .then((res) => {
                const data = res;
                setExperiences(data.data);
            })
            .catch((err) => {
                alert("Error when fetching data");
            });
    };

    const getPortfolios = async () => {
        await axios.get(`${url}/portfolios`).then((res) => {
            const data = res.data;
            let state = [];
            for (let i = 0; i < data.length; i++) {
                let imageArrays = [];
                let images = JSON.parse(data[i].images);
                if (Array.isArray(images)) {
                    imageArrays = images;
                } else {
                    imageArrays = Object.values(images);
                }
                state.push({
                    id: data[i].id,
                    title: data[i].title,
                    first_image: imageArrays[0].initialPreview[0],
                });
            }
            setPortfolios(state);
        });
        console.log(portfolios);
    };

    const getAllData = async () => {
        setIsLoading(true);
        await getExperiences();
        await getSkills();
        await getPortfolios();
        AOS.init();
        setIsLoading(false);
    };

    useEffect(() => {
        getAllData();
    }, []);

    if (!isLoading) {
        return (
            <div className="App">
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
                <Footer />
            </div>
        );
    } else {
        return <div>Loading....</div>;
    }
}

export default App;
