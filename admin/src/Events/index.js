import EventIcon from '@material-ui/icons/Event';
import { EventList } from './List';
import { EventCreate } from './Create';
import { EventEdit } from './Edit';

export default {
    list: EventList,
    create: EventCreate,
    edit: EventEdit,
    icon: EventIcon,
    options: { label: 'Les évènements' }
};
