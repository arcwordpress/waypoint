import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Home from './components/Home';
import DocSetPage from './components/DocSetPage';
import DocGroupPage from './components/DocGroupPage';
import DocPage from './components/DocPage';
import Tester from './components/Tester';

// Get the first path segment as the basename
const pathSegments = window.location.pathname.split('/').filter(Boolean);
const basename = pathSegments.length ? `/${pathSegments[0]}` : '/';

function App() {
    return (
        <Router basename={basename}>
            <div className="w-full lg:max-w-[1280px] lg:mx-auto">
                <Routes>
                    <Route path="/" element={<Home />} />
                    <Route path="/:docsetSlug" element={<DocSetPage />} />
                    <Route path="/:docsetSlug/:groupSlug" element={<DocGroupPage />} />
                    <Route path="/:docsetSlug/:groupSlug/:docSlug" element={<DocPage />} />
                    <Route path="/tester" element={<Tester />} />
                </Routes>
            </div>
        </Router>
    );
}

export default App;
