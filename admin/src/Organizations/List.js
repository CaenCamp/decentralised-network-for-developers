import React from "react";
import { PropTypes } from 'prop-types';
import {
    Datagrid,
    EditButton,
    List,
    TextField,
    Filter,
    TextInput,
    ChipField,
    ReferenceArrayField,
    SingleFieldList,
} from 'react-admin';

export const Logo = ({ record }) => {
    return record && record.image ? (
        <img src={record.image} height="50" alt={record.name} />
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

export const Address = ({ record }) => {
    return (
        <div>
            {record.location.address.streetAddress}<br />
            {record.location.address.postalCode} {record.location.address.addressLocality}
        </div>
    );
};
Address.propTypes = {
    record: PropTypes.shape({
        name: PropTypes.string.isRequired,
        image: PropTypes.string,
    }),
};

const OrganizationFilter = props => (
    <Filter {...props}>
        <TextInput source="name" Label="Nom" alwaysOn />
        <TextInput source="location.address.postalCode" label="Code Postal" alwaysOn />
        <TextInput source="location.address.addressLocality" label="Ville" alwaysOn />
    </Filter>
);

export const OrganizationList = (props) => (
    <List
        {...props}
        filters={<OrganizationFilter />}
        sort={{ field: 'name', order: 'ASC' }}
        bulkActionButtons={false}
        title="Liste des organisations participant aux CaenCamp.s"
        perPage={25}
    >
        <Datagrid>
            <Logo label="Logo" />
            <TextField source="name" label="Nom" />
            <Address source="location.address.postalCode" label="Adresse" />
            <TextField source="disambiguatingDescription" label="Résumé" />
            <ReferenceArrayField label="Membres" reference="people" source="members">
                <SingleFieldList>
                    <ChipField source="name" />
                </SingleFieldList>
            </ReferenceArrayField>
            <EditButton />
        </Datagrid>
    </List>
);

