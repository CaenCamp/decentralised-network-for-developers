import OrganizationIcon from '@material-ui/icons/HomeWork';
import { OrganizationList } from './List';
import { OrganizationCreate } from './Create';
import { OrganizationEdit } from './Edit';

export default {
    list: OrganizationList,
    create: OrganizationCreate,
    edit: OrganizationEdit,
    icon: OrganizationIcon,
    options: { label: 'Les organisations' }
};
