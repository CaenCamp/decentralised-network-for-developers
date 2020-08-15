import React from "react";
import { PropTypes } from 'prop-types';
import {
    Datagrid,
    EditButton,
    List,
    TextField,
    Filter,
    TextInput,
} from 'react-admin';

const Logo = ({ record }) => {
    return record && record.logo ? (
        <img src={record.image} height="50" alt={record.name} />
    ) : (
        `Pas de image pour "${record.name}"`
    );
};
Logo.propTypes = {
    record: PropTypes.shape({
        name: PropTypes.string.isRequired,
        image: PropTypes.string,
    }),
};

const EventFilter = props => (
    <Filter {...props}>
        <TextInput source="name" label="Nom" alwaysOn />
    </Filter>
);

export const EventList = (props) => (
    <List
        {...props}
        filters={<EventFilter />}
        sort={{ field: 'name', order: 'ASC' }}
        bulkActionButtons={false}
        title="Liste des évènements"
        perPage={25}
    >
        <Datagrid>
            <Logo label="Logo" />
            <TextField source="name" label="Nom" />
            <TextField source="disambiguatingDescription" label="Résumé" />
            <TextField source="url" label="Site" />
            <EditButton />
        </Datagrid>
    </List>
);

