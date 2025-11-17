import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Home from './components/Home';
import DocSetPage from './components/DocSetPage';
import DocGroupPage from './components/DocGroupPage';
import DocPage from './components/DocPage';

function App() {
    return (
        <Router basename="/docs">
            <div className="w-full lg:max-w-[1280px] lg:mx-auto">
                <Routes>
                    <Route path="/" element={<Home />} />
                    <Route path="/:docsetSlug" element={<DocSetPage />} />
                    <Route path="/:docsetSlug/:groupSlug" element={<DocGroupPage />} />
                    <Route path="/:docsetSlug/:groupSlug/:docSlug" element={<DocPage />} />
                </Routes>
            </div>
        </Router>
    );
}

export default App;
