import Pill from './Pill/Pill';
import Protocol from './Protocol/Protocol';
import SplitRow from './SplitRow/SplitRow';
import MenuItem from './MenuItem/MenuItem';
import './Pill/style.css';
import Menu from './Menu/Menu';
import ScrollBox from './ScrollBox/ScrollBox';
import SplitLayout from './SplitLayout/SplitLayout';

function Tester() {
    return (
        <SplitLayout
            sidebar={
                <ScrollBox>
                    <Menu dir="v">
                        <MenuItem to="/retrieve">
                            <SplitRow>
                                <span>Retrieve a message</span>
                                <Protocol method="GET"/>
                            </SplitRow>
                        </MenuItem>
                        <MenuItem to="/send">
                            <SplitRow>
                                <span>Send a message</span>
                                <Protocol method="POST"/>
                            </SplitRow>
                        </MenuItem>
                    </Menu>
                </ScrollBox>
            }
            header={
                <h2 style={{ margin: 0 }}>Tester Header</h2>
            }
        >
            <Protocol method="POST"/>
            <Protocol method="PUT"/>
            <Pill>Try Harder</Pill>
            <p>
                We write our components inside of folders so that we can ship default styles per component using BEM.
            </p>
            <h2>Key Drivers</h2>
            <ul>
                <ol>Make components that are suitable for conversion to blocks.</ol>
            </ul>
        </SplitLayout>
    );
}

export default Tester;