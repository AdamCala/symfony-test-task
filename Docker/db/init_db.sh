set -e

# Check if the database exists
if psql -h "$POSTGRES_HOST" -U "$POSTGRES_USER" -lqt | cut -d \| -f 1 | grep -qw symfonydb; then
    echo "Database symfonydb already exists, skipping creation."
else
    # Create the database
    psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" <<-EOSQL
        CREATE DATABASE symfonydb;
        CREATE USER symfonyuser WITH ENCRYPTED PASSWORD 'admin';
        GRANT ALL PRIVILEGES ON DATABASE symfonydb TO symfonyuser;
EOSQL
    echo "Database symfonydb created successfully."
fi