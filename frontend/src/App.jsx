/* eslint-disable react-hooks/exhaustive-deps */
import { useEffect, useRef, useState } from "react";
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
    const mobileNavActiveRef = useRef(false);
    const iconRef = useRef(null);

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
                if (data[i].images){
                    let images = JSON.parse(data[i].images);
                    if (Array.isArray(images)) {
                        imageArrays = images;
                    } else {
                        imageArrays = Object.values(images);
                    }
                }
                state.push({
                    id: data[i].id,
                    title: data[i].title,
                    first_image: imageArrays.length > 0 ? imageArrays[0].initialPreview[0] : null,
                });
            }
            setPortfolios(state);
        });
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

    const toggleMobileNav = () => {
        // toggle state ref
        mobileNavActiveRef.current = !mobileNavActiveRef.current;

        // toggle body class
        if (mobileNavActiveRef.current) {
            document.body.classList.add("mobile-nav-active");
        } else {
            document.body.classList.remove("mobile-nav-active");
        }

        // toggle icon class
        if (iconRef.current) {
            iconRef.current.classList.toggle("bi-x");
            iconRef.current.classList.toggle("bi-list");
        }
    };

    const onClickMenu = () => {
        if (mobileNavActiveRef.current) {
            mobileNavActiveRef.current = false;
            document.body.classList.remove("mobile-nav-active");
            if (iconRef.current) {
                iconRef.current.classList.remove("bi-x");
                iconRef.current.classList.add("bi-list");
            }
        }
    };

    if (!isLoading) {
        return (
            <div className="App">
                {/* Mobile nav toggle button */}
                <i
                    ref={iconRef}
                    onClick={toggleMobileNav}
                    className="bi mobile-nav-toggle d-xl-none bi-list"
                ></i>
                <Header onClickMenu={() => onClickMenu()} />
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
        return <div>Loading...</div>;
    }
}

export default App;
