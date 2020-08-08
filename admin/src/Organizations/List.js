import React from "react";
import { PropTypes } from 'prop-types';
import {
    ListGuesser,
} from "@api-platform/admin";
import {
    TextField,
} from 'react-admin';

const OrganizationLogo = ({ record }) => {
    return record && record.image ? (
        <img src={record.image} height="100" alt={record.name} />
    ) : (
        `Pas de logo pour "${record.name}"`
    );
};
OrganizationLogo.propTypes = {
    record: PropTypes.shape({
        name: PropTypes.string.isRequired,
        image: PropTypes.string,
    }),
};

export const OrganizationList = (props) => (
    <ListGuesser
        {...props}
        sort={{ field: 'name', order: 'ASC' }}
        bulkActionButtons={false}
        title="Les boites du réseau"
        perPage={25}
    >
        <OrganizationLogo label="Logo" />
        <TextField source="name" label="Nom" />
    </ListGuesser>
);

