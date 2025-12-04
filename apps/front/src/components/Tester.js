import Pill from './Pill/Pill';
import Protocol from './Protocol/Protocol';
import SplitRow from './SplitRow/SplitRow';
import MenuItem from './MenuItem/MenuItem';
import './Pill/style.css';
import Menu from './Menu/Menu';

function Tester() {
    return(
        <div style={{margin: '4rem auto', maxWidth: '1120px'}}>
            <h2>Tester</h2>
            
            <Protocol method="POST"/>
            <Protocol method="PUT"/>
            <Pill>Try Harder</Pill>
            <Menu dir="v">
                <MenuItem to="/retrieve">
                    <SplitRow>
                        <span>Retrieve a message</span>
                        <Protocol method="GET"/>
                    </SplitRow>
                </MenuItem>
            </Menu>
            <p>
                We write our components inside of folders so that we can ship default styles per component using BEM.
            </p>
            <h2>Key Drivers</h2>
            <ul>
                <ol>Make components that are suitable for conversion to blocks.</ol>
            </ul>
        </div>
        
    )
}

export default Tester;