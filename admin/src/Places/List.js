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

import { Address } from '../Organizations/List';

const Logo = ({ record }) => {
    return record && record.logo ? (
        <img src={record.logo} height="50" alt={record.name} />
    ) : (
        `Pas de logo pour "${record.name}"`
    );
};
Logo.propTypes = {
    record: PropTypes.shape({
        name: PropTypes.string.isRequired,
        image: PropTypes.string,
    }),
};

const PlaceFilter = props => (
    <Filter {...props}>
        <TextInput source="address.postalCode" label="Code postal" alwaysOn />
    </Filter>
);

export const PlaceList = (props) => (
    <List
        {...props}
        filters={<PlaceFilter />}
        sort={{ field: 'name', order: 'ASC' }}
        bulkActionButtons={false}
        title="Liste des lieux liés aux CaenCamp.s"
        perPage={25}
        filterDefaultValues={{ 'exists[name]': true }}
    >
        <Datagrid>
            <Logo label="Logo" />
            <TextField source="name" label="Nom" />
            <TextField source="disambiguatingDescription" label="Résumé" />
            <TextField source="url" label="Site" />
            <Address source="address.postalCode" label="Adresse" />
            <EditButton />
        </Datagrid>
    </List>
);

